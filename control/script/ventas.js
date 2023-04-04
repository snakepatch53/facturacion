let VentaMain = () => {
    Venta.crud.selectProductoVenta();
    Venta.crud.selectCliente();
    Venta.crud.selectProducto();
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
    Venta.view.formData.producto_cantidad.onkeyup = (event) => Venta.action.loadPricesBeforeInsertProduct(event);
    Venta.view.formData.producto_cantidad.onclick = (event) => Venta.action.loadPricesBeforeInsertProduct(event);

    Venta.view.selectReport.onchange = () => {
        let select = Venta.view.selectReport;
        switch (select.value) {
            case 'pdf':
                window.open('ventas/pdf');
                break;
            case 'excel':
                window.open('ventas/excel');
                break;
            case 'csv':
                window.open('ventas/csv');
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
        selectProductoVenta: () => {
            fetch_query(null, "producto_venta", "select").then(res => {
                Venta.databaseProducto_venta = res;
                Venta.fun.loadTable(res);
                Venta.action.showForm(false, 0);
            }).catch(res => console.log("Error de conexión: " + res));
        },
        inserProductotVenta: () => {
            Venta.fun.showProgress(true, "Guardando nueva venta...");
            let formData = new FormData(Venta.view.formData);
            formData.append("producto_array", JSON.stringify(Venta.databaseProductoCache));
            fetch_query(formData, "producto_venta", "insert").then(res => {
                if (res != false) {
                    window.open('ventas/pdf/' + res);
                    Venta.crud.selectProductoVenta();
                } else {
                    Venta.action.showVentaMsg("Problemas con el servidor!");
                }
                Venta.fun.showProgress(false, "Venta guardada!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        // updateProductoVenta: () => {
        //     let formData = new FormData(Compra.view.formData);
        //     fetch_query(formData, "producto_entrada", "update").then(res => {
        //         Compra.crud.select();
        //     }).catch(res => console.log("Error de conexión: " + res));
        // },
        deleteProductoVenta: (producto_venta_id) => {
            Venta.fun.showProgress(true, "Eliminando la venta...");
            let formData = new FormData(Venta.view.formData);
            formData.append("producto_venta_id", producto_venta_id);
            fetch_query(formData, "producto_venta", "delete").then(res => {
                Venta.crud.selectProductoVenta();
                Venta.fun.showProgress(false, "Venta eliminada!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        selectCliente: () => {
            fetch_query(null, "cliente", "select").then(res => {
                Venta.databaseCliente = res;
            }).catch(res => console.log("Error de conexión: " + res));
        },
        selectProducto: () => {
            fetch_query(null, "producto", "select").then(res => {
                Venta.databaseProducto = res;
                Venta.action.loadTableProducto(Venta.databaseProducto);
            }).catch(res => console.log("Error de conexión: " + res));
        }
    },
    fun: {
        loadTable: (array) => {
            let html = '';
            for (let i of array) {
                html += `
                    <tr>
                        <td><span class="td-span">${ i.producto_venta_fecha }</span></td>
                        <td><span class="td-span">${ i.usuario_nombre }</span></td>
                        ${ i.cliente_id == 0 ? `
                        <td><span class="td-span" style="color: var(--info);">Consumidor Final</span></td>
                        ` : `
                        <td><span class="td-span">${ i.cliente_nombre1 } ${ i.cliente_apellido1 }</span></td>
                        `}
                        <td><span class="td-span" style="color:blue;">$${ i.producto_venta_total }</span></td>
                        <td class="td-action">
                            <div class="buttons-flex">
                                <button class="edit ideabutton" onclick="window.open('ventas/pdf/${ i.producto_venta_id }')">
                                    <img src="view/src/icon/pdf.png">
                                    <span>Factura</span>
                                </button>
                                <button class="delete ideabutton" onclick="Venta.fun.showConfirm(true, () => Venta.crud.deleteProductoVenta(${ i.producto_venta_id }))">
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
            if (Venta.databaseProductoCache.length <= 0) {
                Venta.action.showVentaMsg("No hay productos cargados en la venta!");
                return;
            } else if (Venta.view.formData.producto_venta_fecha.value == "") {
                Venta.action.showVentaMsg("Ingresa la fecha de venta!");
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
                        txt == i.producto_venta_fecha.substring(0, txt.length).toLowerCase() ||
                        txt == i.usuario_nombre.substring(0, txt.length).toLowerCase() ||
                        (i.cliente_id != 0 && txt == i.cliente_nombre1.substring(0, txt.length).toLowerCase()) ||
                        (i.cliente_id != 0 && txt == i.cliente_nombre2.substring(0, txt.length).toLowerCase()) ||
                        (i.cliente_id != 0 && txt == i.cliente_apellido1.substring(0, txt.length).toLowerCase()) ||
                        (i.cliente_id != 0 && txt == i.cliente_apellido2.substring(0, txt.length).toLowerCase()) ||
                        (i.cliente_id == 0 && txt == "consumidor final".substring(0, txt.length).toLocaleLowerCase())
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
                        txt == i.cliente_nombre1.substring(0, txt.length).toLowerCase() ||
                        txt == i.cliente_nombre2.substring(0, txt.length).toLowerCase() ||
                        txt == i.cliente_apellido1.substring(0, txt.length).toLowerCase() ||
                        txt == i.cliente_apellido2.substring(0, txt.length).toLowerCase() ||
                        txt == i.cliente_cedula.substring(0, txt.length).toLowerCase()
                    ) {
                        Venta.view.formData.cliente_id.value = i.cliente_id;
                        Venta.view.formData.cliente_cedula.value = i.cliente_cedula;
                        Venta.view.formData.cliente_nombre.value = i.cliente_nombre1 + " " + i.cliente_nombre2 + " " + i.cliente_apellido1 + " " + i.cliente_apellido2;
                        Venta.view.formData.cliente_contacto.value = i.cliente_celular + ((i.cliente_telefono != "") ? " / " + i.cliente_telefono : "");
                        Venta.view.formData.cliente_direccion.value = i.cliente_direccion;
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
            if (producto.producto_cantidad > 0) {
                Venta.view.formData.producto_id.value = producto.producto_id;
                Venta.view.formData.producto_codigo.value = "Código: " + producto.producto_codigo;
                Venta.view.formData.producto_nombre.value = "Nombre: " + producto.producto_nombre;
                Venta.view.formData.producto_precio.value = "Unidad: $" + producto.producto_precio;
                Venta.view.formData.producto_precioT.value = "Total: $" + producto.producto_precio;
                Venta.precioUnitarioGlobalTemporal = producto.producto_precio;
                Venta.view.formData.producto_cantidad.value = "1";
                Venta.view.formData.producto_cantidad.focus();
            } else {
                Venta.action.clearInfoProducto();
                Venta.action.showProductoMsg(`Producto "${ producto.producto_nombre }" no disponible!`);
            }
        },
        clearInfoProducto: () => {
            Venta.view.formData.producto_id.value = "";
            Venta.view.formData.producto_codigo.value = "Código";
            Venta.view.formData.producto_nombre.value = "Nombre";
            Venta.view.formData.producto_precio.value = "Unidad $";
            Venta.view.formData.producto_precioT.value = "Total $";
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
                let rowTotal = parseFloat(producto.producto_precio) * parseFloat(cantidad);
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
                        <td>$${ producto.producto_precio }</td>
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
        loadPricesBeforeInsertProduct: (event) => {
            let precioTemp = parseFloat(Venta.precioUnitarioGlobalTemporal);
            let cantidadTemp = event.target.value;
            if (precioTemp != NaN && precioTemp != 0 && cantidadTemp != "") {
                Venta.view.formData.producto_precioT.value = "Total: $" + (precioTemp * parseFloat(cantidadTemp)).toFixed(2);
            } else {
                Venta.view.formData.producto_precioT.value = "Total: $" + precioTemp.toFixed(2);
            }
        },
        // Crud factura
        insertProductoFactura: () => {
            let producto_id = Venta.view.formData.producto_id.value;
            let producto_cantidad = Venta.view.formData.producto_cantidad.value;
            let producto = Venta.databaseProducto.find(element => element.producto_id == producto_id);
            producto_cantidad = producto_cantidad == "" ? 1 : producto_cantidad;
            if (producto_id != "") {
                if (Venta.view.formData.producto_cantidad.value != "" && Venta.view.formData.producto_cantidad.value > 0) {
                    let existProducto = Venta.databaseProductoCache.find(element => element.producto_id == producto_id);
                    if (existProducto != undefined) {
                        if ((parseFloat(producto.producto_cantidad) - parseFloat(existProducto.producto_cantidad)) >= producto_cantidad) {
                            existProducto.producto_cantidad = (parseFloat(existProducto.producto_cantidad) + parseFloat(producto_cantidad));
                            Venta.action.deleteProductoFactura(producto_id);
                            Venta.databaseProductoCache.push(existProducto);
                        } else {
                            Venta.action.showProductoMsg(`Solo dispone de "${ producto.producto_cantidad }" de "${ producto.producto_nombre }"`);
                        }
                    } else {
                        if (producto.producto_cantidad >= producto_cantidad) {
                            let producto_db = {
                                producto_id: producto_id,
                                producto_cantidad: parseFloat(producto_cantidad),
                                producto_precio: parseFloat(producto.producto_precio),
                                producto_comision: parseFloat(producto.producto_comision)
                            }
                            Venta.databaseProductoCache.push(producto_db);
                        } else {
                            Venta.action.showProductoMsg(`Solo dispone de "${ producto.producto_cantidad }" de "${ producto.producto_nombre }"`);
                        }
                    }
                    Venta.action.loadTableFactura(Venta.databaseProductoCache);
                    Venta.action.clearInfoProducto();
                } else {
                    Venta.action.showProductoMsg("Inserte una cantidad mayor a cero!");
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