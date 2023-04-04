let ProductoMain = async () => {
    await Producto.crud.selectProducto_entrada();
    await Producto.crud.selectProducto_salida();
    await Producto.crud.select();
    Producto.crud.selectBodega();
    Producto.view.inputNewButton.onclick = () => Producto.fun.showForm(true, 0);
    Producto.view.formButtonCancel.onclick = () => Producto.fun.showForm(false, 0);
    Producto.view.formButtonSave.onclick = () => Producto.fun.submitForm();
    Producto.view.modalNo.onclick = () => Producto.fun.showConfirm(false, null);
    Producto.view.modalClose.onclick = () => Producto.fun.showConfirm(false, null);
    Producto.view.inputSearch.onkeyup = () => Producto.fun.search();
    Producto.view.selectReport.onchange = () => {
        let select = Producto.view.selectReport;
        switch (select.value) {
            case 'pdf':
                window.open('producto/pdf');
                break;
            case 'excel':
                window.open('producto/excel');
                break;
            case 'csv':
                window.open('producto/csv');
                break;
        }
        select.value = "";
    }
}

let Producto = {
    databaseProducto: [],
    databaseProducto_entrada: [],
    databaseProducto_salida: [],
    view: {
        sectionHead: document.getElementById("sectionHead"),
        selectReport: document.getElementById("selectReport"),
        inputSearch: document.getElementById("inputSearch"),
        inputNewButton: document.getElementById("inputNewButton"),
        sectionTable: document.getElementById("sectionTable"),
        tableData: document.getElementById("tableData"),
        sectionForm: document.getElementById("sectionForm"),
        formData: document.getElementById("formData"),
        formButtonSave: document.getElementById("formButtonSave"),
        formButtonCancel: document.getElementById("formButtonCancel"),
        formMsg: document.getElementById("formMsg"),
        sectionModal: document.getElementById("sectionModal"),
        modalText: document.getElementById("modalText"),
        modalClose: document.getElementById("modalClose"),
        modalNo: document.getElementById("modalNo"),
        modalYes: document.getElementById("modalYes"),
        sectionProgress: document.getElementById("sectionProgress"),
        sectionProgressText: document.getElementById("sectionProgressText")
    },
    crud: {
        select: async () => {
            await fetch_query(null, "producto", "select").then(res => {
                Producto.databaseProducto = res;
                Producto.fun.loadTable(res);
                Producto.fun.showForm(false, 0);
            }).catch(res => console.log("Error de conexión: " + res));
        },
        insert: () => {
            Producto.fun.showProgress(true, "Guardando nuevo producto...");
            let formData = new FormData(Producto.view.formData);
            fetch_query(formData, "producto", "insert").then(res => {
                Producto.crud.select();
                Producto.fun.showProgress(false, "Producto eliminado!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        update: () => {
            Producto.fun.showProgress(true, "Actualizando el producto...");
            let formData = new FormData(Producto.view.formData);
            fetch_query(formData, "producto", "update").then(res => {
                Producto.crud.select();
                Producto.fun.showProgress(false, "Producto actualizado!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        delete: (producto_id) => {
            Producto.fun.showProgress(true, "Eliminando nuevo producto...");
            let formData = new FormData(Producto.view.formData);
            formData.append("producto_id", producto_id);
            fetch_query(formData, "producto", "delete").then(res => {
                Producto.crud.select();
                Producto.fun.showProgress(false, "Producto eliminado!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        selectBodega: () => {
            fetch_query(null, "bodega", "select").then(res => {
                let html = '<option value="">Selecciona una Estanteria</option>';
                for (let i of res) {
                    html += `<option value="${ i.bodega_id }">${ i.bodega_nombre }</option>`;
                }
                Producto.view.formData.bodega_id.innerHTML = html;
            }).catch(res => console.log("Error de conexión: " + res));
        },
        selectProducto_entrada: async () => {
            await fetch_query(null, "producto_entrada", "select").then(res => {
                Producto.databaseProducto_entrada = res;
            }).catch(res => console.log("Error de conexión: " + res));
        },
        selectProducto_salida: async () => {
            await fetch_query(null, "producto_salida", "select").then(res => {
                Producto.databaseProducto_salida = res;
            }).catch(res => console.log("Error de conexión: " + res));
        }
    },
    fun: {
        loadTable: (array) => {
            let html = '';
            for (let i of array) {
                let deleteable = isDeleteable(Producto.databaseProducto_entrada, i.producto_id, "producto_id") && isDeleteable(Producto.databaseProducto_salida, i.producto_id, "producto_id");
                html += `
                    <tr>
                        <td>
                            ${ i.producto_foto == null ? `
                                <img src="view/src/img/product.png" class="td-photo photo-product" />
                            ` : `
                                <img src="view/src/file/producto_foto/${ i.producto_foto }?date=${ $dateTime }" class="td-photo photo-product" />
                            ` }
                        </td>
                        <td><span class="td-span">${ i.producto_codigo }</span></td>
                        <td><span class="td-span">${ i.producto_nombre }</span></td>
                        <td><span class="td-span">${ i.producto_modelo }</span></td>
                        <td><span class="td-span">${ i.producto_cantidad }</span></td>
                        <td><span class="td-span">$${ i.producto_precio }</span></td>
                        <td><span class="td-span">${ i.bodega_nombre }</span></td>
                        <td class="td-action">
                            <div class="buttons-flex">
                                <button class="edit ideabutton" onclick="Producto.fun.showForm(true, ${ i.producto_id })">
                                    <img src="view/src/icon/edit.png">
                                    <span>Editar</span>
                                </button>
                                <button class="delete ideabutton ${ !deleteable ? "disabled" : "" }" onclick="Producto.fun.showConfirm(true, () => Producto.crud.delete(${ i.producto_id }))" ${ !deleteable ? "disabled" : "" }>
                                    <img src="view/src/icon/delete.png">
                                    <span>Eliminar</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }
            Producto.view.tableData.innerHTML = html;
        },
        showForm: (bool, producto_id) => {
            if (bool) {
                Producto.view.sectionHead.classList.remove("open");
                Producto.view.sectionTable.classList.remove("open");
                Producto.view.sectionModal.classList.remove("open");
                Producto.view.sectionForm.classList.add("open");
                if (producto_id != 0) {
                    let producto = Producto.databaseProducto.find(element => element.producto_id == producto_id);
                    Producto.view.formData.producto_id.value = producto.producto_id;
                    Producto.view.formData.producto_nombre_view.value = producto.producto_nombre;
                    Producto.view.formData.producto_nombre.value = producto.producto_nombre;
                    Producto.view.formData.producto_codigo.value = producto.producto_codigo;
                    Producto.view.formData.producto_marca.value = producto.producto_marca;
                    Producto.view.formData.producto_modelo.value = producto.producto_modelo;
                    Producto.view.formData.producto_elaboracion.value = producto.producto_elaboracion;
                    Producto.view.formData.producto_vencimiento.value = producto.producto_vencimiento;
                    Producto.view.formData.producto_descripcion.value = producto.producto_descripcion;
                    Producto.view.formData.bodega_id.value = producto.bodega_id;
                }
            } else {
                Producto.view.sectionHead.classList.add("open");
                Producto.view.sectionTable.classList.add("open");
                Producto.view.sectionModal.classList.remove("open");
                Producto.view.sectionForm.classList.remove("open");
                Producto.fun.clearForm();
            }
        },
        submitForm: () => {
            let form = Producto.view.formData;
            if (
                Producto.view.formData.producto_nombre.value == "" ||
                Producto.view.formData.producto_codigo.value == "" ||
                Producto.view.formData.producto_marca.value == "" ||
                Producto.view.formData.producto_vencimiento.value == "" ||
                Producto.view.formData.bodega_id.value == ""
            ) {
                Producto.fun.showMsg("Debe llenar todos los campos!");
                return;
            } else if (existData(Producto.databaseProducto, form.producto_codigo.value, "producto_codigo", form.producto_id.value, "producto_id")) {
                Producto.fun.showMsg("Código de producto en uso!");
                return;
            }
            if (Producto.view.formData.producto_id.value == 0) {
                Producto.crud.insert();
            } else {
                Producto.crud.update();
            }
        },
        search: () => {
            let txt = Producto.view.inputSearch.value.toLowerCase();
            if (txt.trim() == "") {
                Producto.fun.loadTable(Producto.databaseProducto);
            } else {
                let array = [];
                for (let i of Producto.databaseProducto) {
                    if (
                        txt == i.producto_nombre.substring(0, txt.length).toLowerCase() ||
                        txt == i.producto_codigo.substring(0, txt.length).toLowerCase() ||
                        txt == i.producto_marca.substring(0, txt.length).toLowerCase() ||
                        txt == i.producto_modelo.substring(0, txt.length).toLowerCase() ||
                        txt == i.bodega_nombre.substring(0, txt.length).toLowerCase()
                    ) {
                        array.push(i);
                    }
                }
                Producto.fun.loadTable(array);
            }
        },
        // CAPSULA DE FUNCIONES
        clearForm: () => {
            Producto.view.formData.producto_id.value = 0;
            Producto.view.formData.producto_nombre_view.value = "Nuevo";
            Producto.view.formData.producto_nombre.value = "";
            Producto.view.formData.producto_codigo.value = "";
            Producto.view.formData.producto_marca.value = "";
            Producto.view.formData.producto_modelo.value = "";
            Producto.view.formData.producto_elaboracion.value = "";
            Producto.view.formData.producto_vencimiento.value = "";
            Producto.view.formData.producto_descripcion.value = "";
            Producto.view.formData.producto_foto.value = "";
            Producto.view.formData.bodega_id.value = "";
        },
        showMsg: (txt) => {
            Producto.view.formMsg.innerText = txt;
            setTimeout(() => {
                Producto.view.formMsg.innerText = "";
            }, 1000);
        },
        showConfirm: (bool, action) => {
            if (bool) {
                Producto.view.sectionModal.classList.add("open");
                Producto.view.modalYes.onclick = () => action();
            } else {
                Producto.view.sectionModal.classList.remove("open");
            }
        },
        showProgress: (bool, text) => {
            if (bool) {
                Producto.view.sectionProgressText.innerText = text;
                Producto.view.sectionProgress.classList.add("open");
            } else {
                Producto.view.sectionProgressText.innerText = text;
                setTimeout(() => {
                    Producto.view.sectionProgress.classList.remove("open");
                    Producto.view.sectionProgressText.innerText = "";
                }, 500);
            }
        }
    }
}

ProductoMain();