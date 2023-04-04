let VentaMain = async () => {
    await Venta.crud.selectProducto();
    await Venta.crud.selectProveedor();
    await Venta.crud.selectProductoVenta();
    Venta.action.loadTableFactura(Venta.databaseProductoCache);
    Venta.view.inputNewButton.onclick = () => Venta.action.showForm(true, 0);
    Venta.view.formButtonCancel.onclick = () => Venta.fun.showConfirm(true, () => Venta.action.showForm(false, 0));
    Venta.view.formButtonSave.onclick = () => Venta.fun.submitForm();
    Venta.view.modalNo.onclick = () => Venta.fun.showConfirm(false, null);
    Venta.view.modalClose.onclick = () => Venta.fun.showConfirm(false, null);
    Venta.view.formButtonAddProductoFactura.onclick = () => Venta.action.insertProductoFactura();

    // Searchs
    Venta.view.inputSearchVenta.onkeyup = () => Venta.fun.searchVenta();
    Venta.view.inputSearchCliente.onkeyup = () => Venta.fun.searchCliente();
    Venta.action.searchProductoEvents();

    // Extras
    Venta.view.formData.producto_cantidad.onkeypress = (event) => {
        if (event.code == "Enter") {
            event.preventDefault();
            event.target.value = "1";
        }
    }

    Venta.view.selectReport.onchange = () => {
        let select = Venta.view.selectReport;
        switch (select.value) {
            case 'pdf':
                window.open('compras/pdf');
                break;
            case 'excel':
                window.open('compras/excel');
                break;
            case 'csv':
                window.open('compras/csv');
                break;
        }
        select.value = "";
    }

}

let Venta = {
    databaseProducto_venta: [],
    databaseCliente: [],
    databaseProducto: [],
    databaseProductoCache: [],
    precioUnitarioGlobalTemporal: 0,
    view: {
        sectionHead: document.getElementById("sectionHead"),
        selectReport: document.getElementById("selectReport"),
        inputSearchVenta: document.getElementById("inputSearch"),
        inputSearchCliente: document.getElementById("inputSearchCliente"),
        inputSearchProducto: document.getElementById("inputSearchProducto"),
        searchProductoResults: document.getElementById("searchProductoResults"),
        inputNewButton: document.getElementById("inputNewButton"),
        sectionTable: document.getElementById("sectionTable"),
        tableData: document.getElementById("tableData"),
        dataTableProducto: document.getElementById("dataTableProducto"),
        dataTableFactura: document.getElementById("dataTableFactura"),
        sectionUser: document.getElementById("sectionUser"),
        sectionForm: document.getElementById("sectionForm"),
        ideaformCliente: document.getElementById("ideaform-cliente"),
        formData: document.getElementById("formData"),
        formButtonAddProductoFactura: document.getElementById("formButtonAddProductoFactura"),
        formButtonSave: document.getElementById("formButtonSave"),
        formButtonCancel: document.getElementById("formButtonCancel"),
        ventaMsg: document.getElementById("ventaMsg"),
        productoMsg: document.getElementById("productoMsg"),
        sectionModal: document.getElementById("sectionModal"),
        modalText: document.getElementById("modalText"),
        modalClose: document.getElementById("modalClose"),
        modalNo: document.getElementById("modalNo"),
        modalYes: document.getElementById("modalYes"),
        buttonShowPass: document.getElementById("buttonShowPass"),
        resultFacturaSubtotal: document.getElementById("resultFacturaSubtotal"),
        resultFacturaIVA: document.getElementById("resultFacturaIVA"),
        resultFacturaTotal: document.getElementById("resultFacturaTotal"),
        sectionProgress: document.getElementById("sectionProgress"),
        sectionProgressText: document.getElementById("sectionProgressText")
    },
    crud: {
        selectProductoVenta: async () => {
            await fetch_query(null, "producto_compra", "select").then(res => {
                Venta.databaseProducto_venta = res;
                Venta.fun.loadTable(res);
                Venta.action.showForm(false, 0);
            }).catch(res => console.log("Error de conexión: " + res));
        },
        inserProductotVenta: () => {
            Venta.fun.showProgress(true, "Guardando nueva compra...");
            let formData = new FormData(Venta.view.formData);
            formData.append("producto_array", JSON.stringify(Venta.databaseProductoCache));
            formData.append("proveedor_id", Venta.view.formData.cliente_id.value);
            fetch_query(formData, "producto_compra", "insert").then(res => {
                if (res != false) {
                    window.open('compras/pdf/' + res);
                    Venta.crud.selectProductoVenta();
                } else {
                    Venta.action.showVentaMsg("Problemas con el servidor!");
                }
                Venta.fun.showProgress(false, "Compra guardada!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        deleteProductoVenta: (producto_venta_id) => {
            Venta.fun.showProgress(true, "Eliminando la compra...");
            let formData = new FormData(Venta.view.formData);
            formData.append("producto_compra_id", producto_venta_id);
            fetch_query(formData, "producto_compra", "delete").then(res => {
                Venta.crud.selectProductoVenta();
                Venta.fun.showProgress(false, "Compra eliminada!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        selectProveedor: async () => {
            await fetch_query(null, "proveedor", "select").then(res => {
                Venta.databaseCliente = res;
            }).catch(res => console.log("Error de conexión: " + res));
        },
        selectProducto: async () => {
            await fetch_query(null, "producto", "select").then(res => {
                Venta.databaseProducto = res;
                Venta.action.loadTableProducto(Venta.databaseProducto);
            }).catch(res => console.log("Error de conexión: " + res));
        }
    },
    fun: {
        loadTable: (array) => {
            let html = '';
            for (let i of array) {
                let deleteable = isDeleteableCompra(Venta.databaseProducto, i.producto_entrada_array);
                html += `
                    <tr>
                        <td><span class="td-span">${ i.producto_compra_fecha }</span></td>
                        <td><span class="td-span">${ i.usuario_nombre }</span></td>
                        <td><span class="td-span">${ i.proveedor_nombre }</span></td>
                        <td><span class="td-span" style="color:blue;">$${ i.producto_compra_total }</span></td>
                        <td class="td-action">
                            <div class="buttons-flex">
                                <button class="edit ideabutton" onclick="window.open('compras/pdf/${ i.producto_compra_id }')">
                                    <img src="view/src/icon/pdf.png">
                                    <span>Factura</span>
                                </button>
                                <button class="delete ideabutton ${ !deleteable ? "disabled" : "" }" onclick="Venta.fun.showConfirm(true, () => Venta.crud.deleteProductoVenta(${ i.producto_compra_id }))" ${ !deleteable ? "disabled" : "" }>
                                    <img src="view/src/icon/delete.png">
                                    <span>Eliminar</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }
            Venta.view.tableData.innerHTML = html;
        },
        submitForm: () => {
            if (Venta.view.formData.cliente_id.value == 0 || Venta.view.formData.cliente_id.value == "") {
                Venta.action.showVentaMsg("Seleccione un proveedor en la parte superior!");
                return;
            } else if (Venta.databaseProductoCache.length <= 0) {
                Venta.action.showVentaMsg("No hay productos cargados en la compra!");
                return;
            } else if (Venta.view.formData.producto_venta_fecha.value == "") {
                Venta.action.showVentaMsg("Ingresa la fecha de compra!");
                return;
            }
            Venta.crud.inserProductotVenta();
        },


        searchVenta: () => {
            let txt = Venta.view.inputSearchVenta.value.toLowerCase();
            if (txt.trim() == "") {
                Venta.fun.loadTable(Venta.databaseProducto_venta);
            } else {
                let array = [];
                for (let i of Venta.databaseProducto_venta) {
                    if (
                        txt == i.producto_compra_fecha.substring(0, txt.length).toLowerCase() ||
                        txt == i.usuario_nombre.substring(0, txt.length).toLowerCase() ||
                        txt == i.proveedor_nombre.substring(0, txt.length).toLowerCase() ||
                        txt == i.proveedor_ruc.substring(0, txt.length).toLowerCase()
                    ) {
                        array.push(i);
                    }
                }
                Venta.fun.loadTable(array);
            }
        },
        searchCliente: () => {
            let txt = Venta.view.inputSearchCliente.value.toLowerCase();
            if (txt.trim() == "") {
                Venta.action.clearInfoCliente();
            } else {
                for (let i of Venta.databaseCliente) {
                    if (
                        txt == i.proveedor_nombre.substring(0, txt.length).toLowerCase() ||
                        txt == i.proveedor_ruc.substring(0, txt.length).toLowerCase()
                    ) {
                        Venta.view.formData.cliente_id.value = i.proveedor_id;
                        Venta.view.formData.cliente_cedula.value = i.proveedor_ruc;
                        Venta.view.formData.cliente_nombre.value = i.proveedor_nombre;
                        Venta.view.formData.cliente_contacto.value = i.proveedor_telefono + ((i.proveedor_celular != "") ? " / " + i.proveedor_celular : "");
                        Venta.view.formData.cliente_direccion.value = i.proveedor_direccion;
                        Venta.view.ideaformCliente.classList.add("client-data-open");
                        return;
                    }
                }
                Venta.action.clearInfoCliente();
            }
        },
        searchProducto: (limit) => {
            Venta.action.clearInfoProducto();
            let txt = Venta.view.inputSearchProducto.value.toLowerCase();
            if (txt.trim() == "") {
                Venta.action.loadTableProducto(Venta.databaseProducto);
            } else {
                let array = [];
                for (let i of Venta.databaseProducto) {
                    if (
                        txt == i.producto_codigo.substring(0, txt.length).toLowerCase() ||
                        txt == i.producto_nombre.substring(0, txt.length).toLowerCase()
                    ) {
                        array.push(i);
                    }
                }
                Venta.action.loadTableProducto(array);
            }
        },
        // CAPSULA DE FUNCIONES
        clearFormAll: () => {
            Venta.view.inputSearchCliente.value = "";
            Venta.view.inputSearchProducto.value = "";
            Venta.action.clearInfoCliente();
            Venta.action.clearInfoProducto();
            Venta.databaseProductoCache = [];
            Venta.action.loadTableFactura(Venta.databaseProductoCache);
        },

        showConfirm: (bool, action) => {
            if (bool) {
                Venta.view.sectionModal.classList.add("open");
                Venta.view.modalYes.onclick = () => action();
            } else {
                Venta.view.sectionModal.classList.remove("open");
            }
        },
        showProgress: (bool, text) => {
            if (bool) {
                Venta.view.sectionProgressText.innerText = text;
                Venta.view.sectionProgress.classList.add("open");
            } else {
                Venta.view.sectionProgressText.innerText = text;
                setTimeout(() => {
                    Venta.view.sectionProgress.classList.remove("open");
                    Venta.view.sectionProgressText.innerText = "";
                }, 500);
            }
        }
    },
    action: {
        showForm: (bool, producto_venta_id) => {
            if (bool) {
                Venta.view.sectionHead.classList.remove("open");
                Venta.view.sectionTable.classList.remove("open");
                Venta.view.sectionModal.classList.remove("open");
                Venta.view.sectionForm.classList.add("open");
                Venta.view.sectionUser.classList.add("open");
            } else {
                Venta.view.sectionHead.classList.add("open");
                Venta.view.sectionTable.classList.add("open");
                Venta.view.sectionModal.classList.remove("open");
                Venta.view.sectionForm.classList.remove("open");
                Venta.view.sectionUser.classList.remove("open");
            }
            Venta.fun.clearFormAll();
        },
        showVentaMsg: (txt) => {
            Venta.view.ventaMsg.innerText = txt;
            setTimeout(() => {
                Venta.view.ventaMsg.innerText = "";
            }, 1500);
        },
        showProductoMsg: (txt) => {
            Venta.view.productoMsg.innerText = txt;
            setTimeout(() => {
                Venta.view.productoMsg.innerText = "";
            }, 1500);
        },
        searchProductoEvents: () => {
            Venta.view.inputSearchProducto.onkeyup = () => Venta.fun.searchProducto();
            Venta.view.inputSearchProducto.onfocus = () => {
                Venta.view.searchProductoResults.classList.add("open");
            }
            Venta.view.inputSearchProducto.onblur = () => {
                setTimeout(() => {
                    Venta.view.searchProductoResults.classList.remove("open");
                }, 100);
            }
            Venta.view.inputSearchProducto.onkeypress = (event) => {
                if (event.code == "Enter") {
                    event.preventDefault();
                    let value = event.target.value;
                    let producto = Venta.databaseProducto.find(element => element.producto_codigo == value);
                    if (producto != undefined) {
                        Venta.action.loadInfoProducto(producto.producto_id);
                    }
                }
            }

        },
        loadTableProducto: (array) => {
            let html = '';
            for (let i of array) {
                html += `
                    <tr onclick="Venta.action.loadInfoProducto(${ i.producto_id })">
                        <td>
                            ${ i.producto_foto == null ? `
                                <img src="view/src/img/product.png" class="td-photo photo-product" />
                            ` : `
                                <img src="view/src/file/producto_foto/${ i.producto_foto }?date=${ $dateTime }"" class="td-photo photo-product" />
                            ` }
                        </td>
                        <td>${ i.producto_codigo }</td>
                        <td>${ i.producto_nombre }</td>
                        <td>${ i.producto_cantidad }</td>
                        <td>$${ i.producto_precio }</td>
                    </tr>
                `;
            }
            Venta.view.dataTableProducto.innerHTML = html;
        },
        loadInfoProducto: (producto_id) => {
            let producto = Venta.databaseProducto.find(element => element.producto_id == producto_id);
            Venta.view.formData.producto_id.value = producto.producto_id;
            Venta.view.formData.producto_codigo.value = "Código: " + producto.producto_codigo;
            Venta.view.formData.producto_nombre.value = "Nombre: " + producto.producto_nombre;
            Venta.view.formData.producto_precio.value = "";
            Venta.view.formData.producto_comision.value = "";
            Venta.precioUnitarioGlobalTemporal = producto.producto_precio;
            Venta.view.formData.producto_cantidad.value = "1";
            Venta.view.formData.producto_precio.focus();
        },
        clearInfoProducto: () => {
            Venta.view.formData.producto_id.value = "";
            Venta.view.formData.producto_codigo.value = "Código";
            Venta.view.formData.producto_nombre.value = "Nombre";
            Venta.view.formData.producto_precio.value = "";
            Venta.view.formData.producto_comision.value = "";
            Venta.precioUnitarioGlobalTemporal = 0;
            Venta.view.formData.producto_cantidad.value = "1";
        },
        clearInfoCliente: () => {
            Venta.view.formData.cliente_id.value = 0;
            Venta.view.formData.cliente_cedula.value = "";
            Venta.view.formData.cliente_nombre.value = "";
            Venta.view.formData.cliente_contacto.value = "";
            Venta.view.formData.cliente_direccion.value = "";
            Venta.view.ideaformCliente.classList.remove("client-data-open");
        },
        loadTableFactura: (array) => {
            let html = '';
            let colTotal = 0;
            for (let i of array) {
                let producto = Venta.databaseProducto.find(element => element.producto_id == i.producto_id);
                let cantidad = i.producto_cantidad;
                let precio = i.producto_precio;
                let rowTotal = parseFloat(precio) * parseFloat(cantidad);
                colTotal += rowTotal;
                html += `
                    <tr>
                        <td>
                            ${ producto.producto_foto == null ? `
                                <img src="view/src/img/product.png" class="td-photo photo-product" />
                            ` : `
                                <img src="view/src/file/producto_foto/${ producto.producto_foto }?date=${ $dateTime }"" class="td-photo photo-product" />
                            ` }
                        </td>
                        <td>${ producto.producto_codigo }</td>
                        <td>${ producto.producto_nombre }</td>
                        <td>${ cantidad }</td>
                        <td>$${ precio }</td>
                        <td>$${ rowTotal.toFixed(2) }</td>
                        <td class="td-action">
                            <div class="buttons-flex">
                                <button class="ideabutton" onclick="Venta.action.deleteProductoFactura(${ producto.producto_id })">
                                    <img src="view/src/icon/delete.png">
                                    <span>Eliminar</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }
            if (array.length == 0) {
                html += `
                    <tr><td colspan="7" style="padding: 7px 0;">AGREGA UN PRODUCTO</td></tr>
                `;
            }
            Venta.action.clearInfoProducto();
            Venta.view.dataTableFactura.innerHTML = html;
            Venta.view.resultFacturaSubtotal.innerText = "$" + colTotal.toFixed(2);
            Venta.view.resultFacturaIVA.innerText = "$" + ((colTotal / 100) * $informacion_r.informacion_iva).toFixed(2);
            Venta.view.resultFacturaTotal.innerText = "$" + (((colTotal / 100) * $informacion_r.informacion_iva) + colTotal).toFixed(2);
        },
        // Crud factura
        insertProductoFactura: () => {
            let producto_id = Venta.view.formData.producto_id.value;
            let producto_cantidad = Venta.view.formData.producto_cantidad.value;
            let producto_precio = Venta.view.formData.producto_precio.value;
            let producto_comision = Venta.view.formData.producto_comision.value == "" ? 0 : Venta.view.formData.producto_comision.value;
            producto_cantidad = producto_cantidad == "" ? 1 : producto_cantidad;
            if (producto_id != "") {
                if (
                    producto_cantidad != "" &&
                    producto_cantidad > 0 &&
                    producto_precio != "" &&
                    producto_precio > 0
                ) {
                    let existProducto = Venta.databaseProductoCache.find(element => element.producto_id == producto_id);
                    if (existProducto != undefined) {
                        existProducto.producto_cantidad = (parseFloat(existProducto.producto_cantidad) + parseFloat(producto_cantidad));
                        Venta.action.deleteProductoFactura(producto_id);
                        Venta.databaseProductoCache.push(existProducto);
                    } else {
                        let producto_db = {
                            producto_id: producto_id,
                            producto_cantidad: parseFloat(producto_cantidad),
                            producto_precio: parseFloat(producto_precio),
                            producto_comision: parseFloat(producto_comision)
                        }
                        Venta.databaseProductoCache.push(producto_db);
                    }
                    Venta.action.loadTableFactura(Venta.databaseProductoCache);
                    Venta.action.clearInfoProducto();
                } else {
                    Venta.action.showProductoMsg("Llene los datos del producto!");
                }
            } else {
                Venta.action.showProductoMsg("Seleccione un producto con el buscador!");
            }
        },
        deleteProductoFactura: (producto_id) => {
            Venta.databaseProductoCache = Venta.databaseProductoCache.filter(element => element.producto_id != producto_id);
            Venta.action.loadTableFactura(Venta.databaseProductoCache);
        }
    }
}

VentaMain();