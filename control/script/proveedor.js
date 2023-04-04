let ProveedorMain = async () => {
    await Proveedor.crud.selectProductoCompra();
    await Proveedor.crud.select();
    Proveedor.view.inputNewButton.onclick = () => Proveedor.fun.showForm(true, 0);
    Proveedor.view.formButtonCancel.onclick = () => Proveedor.fun.showForm(false, 0);
    Proveedor.view.formButtonSave.onclick = () => Proveedor.fun.submitForm();
    Proveedor.view.modalNo.onclick = () => Proveedor.fun.showConfirm(false, null);
    Proveedor.view.modalClose.onclick = () => Proveedor.fun.showConfirm(false, null);
    Proveedor.view.inputSearch.onkeyup = () => Proveedor.fun.search();
    Proveedor.view.selectReport.onchange = () => {
        let select = Proveedor.view.selectReport;
        switch (select.value) {
            case 'pdf':
                window.open('proveedor/pdf');
                break;
            case 'excel':
                window.open('proveedor/excel');
                break;
            case 'csv':
                window.open('proveedor/csv');
                break;
        }
        select.value = "";
    }
}

let Proveedor = {
    databaseProveedor: [],
    databaseProducto_compra: [],
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
            await fetch_query(null, "proveedor", "select").then(res => {
                Proveedor.databaseProveedor = res;
                Proveedor.fun.loadTable(res);
                Proveedor.fun.showForm(false, 0);
            }).catch(res => console.log("Error de conexión: " + res));
        },
        insert: () => {
            Proveedor.fun.showProgress(true, "Guardando nuevo proveedor...");
            let formData = new FormData(Proveedor.view.formData);
            fetch_query(formData, "proveedor", "insert").then(res => {
                Proveedor.crud.select();
                Proveedor.fun.showProgress(false, "Proveedor guardado!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        update: () => {
            Proveedor.fun.showProgress(true, "Actualizando el proveedor...");
            let formData = new FormData(Proveedor.view.formData);
            fetch_query(formData, "proveedor", "update").then(res => {
                Proveedor.crud.select();
                Proveedor.fun.showProgress(false, "Proveedor actualizado!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        delete: (proveedor_id) => {
            Proveedor.fun.showProgress(true, "Eliminando el proveedor...");
            let formData = new FormData(Proveedor.view.formData);
            formData.append("proveedor_id", proveedor_id);
            fetch_query(formData, "proveedor", "delete").then(res => {
                Proveedor.crud.select();
                Proveedor.fun.showProgress(false, "Proveedor eliminado!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        selectProductoCompra: async () => {
            await fetch_query(null, "producto_compra", "select").then(res => {
                Proveedor.databaseProducto_compra = res;
            }).catch(res => console.log("Error de conexión: " + res));
        }
    },
    fun: {
        loadTable: (array) => {
            let html = '';
            for (let i of array) {
                let deleteable = isDeleteable(Proveedor.databaseProducto_compra, i.proveedor_id, "proveedor_id");
                html += `
                    <tr>
                        <td><span class="td-span">${ i.proveedor_nombre }</span></td>
                        <td><span class="td-span">${ i.proveedor_ciudad }</span></td>
                        <td><span class="td-span">${ i.proveedor_telefono } ${ i.proveedor_celular.trim() != "" ? " / "+i.proveedor_celular : "" } </span></td>
                        <td><span class="td-span">${ i.proveedor_ruc }</span></td>
                        <td class="td-action">
                            <div class="buttons-flex">
                                <button class="edit ideabutton" onclick="Proveedor.fun.showForm(true, ${ i.proveedor_id })">
                                    <img src="view/src/icon/edit.png">
                                    <span>Editar</span>
                                </button>
                                <button class="delete ideabutton ${ !deleteable ? "disabled" : "" }" onclick="Proveedor.fun.showConfirm(true, () => Proveedor.crud.delete(${ i.proveedor_id }))" ${ !deleteable ? "disabled" : "" }>
                                    <img src="view/src/icon/delete.png">
                                    <span>Eliminar</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }
            Proveedor.view.tableData.innerHTML = html;
        },
        showForm: (bool, proveedor_id) => {
            if (bool) {
                Proveedor.view.sectionHead.classList.remove("open");
                Proveedor.view.sectionTable.classList.remove("open");
                Proveedor.view.sectionModal.classList.remove("open");
                Proveedor.view.sectionForm.classList.add("open");
                if (proveedor_id != 0) {
                    let proveedor = Proveedor.databaseProveedor.find(element => element.proveedor_id == proveedor_id);
                    Proveedor.view.formData.proveedor_id.value = proveedor.proveedor_id;
                    Proveedor.view.formData.proveedor_nombre_view.value = proveedor.proveedor_nombre;
                    Proveedor.view.formData.proveedor_nombre.value = proveedor.proveedor_nombre;
                    Proveedor.view.formData.proveedor_provicia.value = proveedor.proveedor_provicia;
                    Proveedor.view.formData.proveedor_ciudad.value = proveedor.proveedor_ciudad;
                    Proveedor.view.formData.proveedor_direccion.value = proveedor.proveedor_direccion;
                    Proveedor.view.formData.proveedor_telefono.value = proveedor.proveedor_telefono;
                    Proveedor.view.formData.proveedor_celular.value = proveedor.proveedor_celular;
                    Proveedor.view.formData.proveedor_email.value = proveedor.proveedor_email;
                    Proveedor.view.formData.proveedor_ruc.value = proveedor.proveedor_ruc;
                }
            } else {
                Proveedor.view.sectionHead.classList.add("open");
                Proveedor.view.sectionTable.classList.add("open");
                Proveedor.view.sectionModal.classList.remove("open");
                Proveedor.view.sectionForm.classList.remove("open");
                Proveedor.fun.clearForm();
            }
        },
        submitForm: () => {
            let form = Proveedor.view.formData;
            if (
                Proveedor.view.formData.proveedor_nombre.value == "" ||
                Proveedor.view.formData.proveedor_ciudad.value == "" ||
                Proveedor.view.formData.proveedor_direccion.value == "" ||
                Proveedor.view.formData.proveedor_telefono.value == "" ||
                Proveedor.view.formData.proveedor_email.value == "" ||
                Proveedor.view.formData.proveedor_ruc.value == ""
            ) {
                Proveedor.fun.showMsg("Debe llenar todos los campos!");
                return;
            } else if (!isTelefono(Proveedor.view.formData.proveedor_telefono.value)) {
                Proveedor.fun.showMsg("Número de Teléfono no válido!");
                return;
            } else if (
                !isCelular(Proveedor.view.formData.proveedor_celular.value) &&
                Proveedor.view.formData.proveedor_celular.value != ""
            ) {
                Proveedor.fun.showMsg("Número de Celular no válido!");
                return;
            } else if (!isEmail(Proveedor.view.formData.proveedor_email.value)) {
                Proveedor.fun.showMsg("Correo electrónico no válido!");
                return;
            } else if (!isRuc(Proveedor.view.formData.proveedor_ruc.value)) {
                Proveedor.fun.showMsg("Número de Ruc no válido!");
                return;
            } else if (existData(Proveedor.databaseProveedor, form.proveedor_ruc.value, "proveedor_ruc", form.proveedor_id.value, "proveedor_id")) {
                Proveedor.fun.showMsg("Ruc en uso!");
                return;
            }
            if (Proveedor.view.formData.proveedor_id.value == 0) {
                Proveedor.crud.insert();
            } else {
                Proveedor.crud.update();
            }
        },
        search: () => {
            let txt = Proveedor.view.inputSearch.value.toLowerCase();
            if (txt.trim() == "") {
                Proveedor.fun.loadTable(Proveedor.databaseProveedor);
            } else {
                let array = [];
                for (let i of Proveedor.databaseProveedor) {
                    if (
                        txt == i.proveedor_nombre.substring(0, txt.length).toLowerCase() ||
                        txt == i.proveedor_ciudad.substring(0, txt.length).toLowerCase() ||
                        txt == i.proveedor_telefono.substring(0, txt.length).toLowerCase() ||
                        txt == i.proveedor_celular.substring(0, txt.length).toLowerCase() ||
                        txt == i.proveedor_ruc.substring(0, txt.length).toLowerCase()
                    ) {
                        array.push(i);
                    }
                }
                Proveedor.fun.loadTable(array);
            }
        },
        // CAPSULA DE FUNCIONES
        clearForm: () => {
            Proveedor.view.formData.proveedor_id.value = 0;
            Proveedor.view.formData.proveedor_nombre_view.value = "Nuevo";
            Proveedor.view.formData.proveedor_nombre.value = "";
            Proveedor.view.formData.proveedor_provicia.value = "";
            Proveedor.view.formData.proveedor_ciudad.value = "";
            Proveedor.view.formData.proveedor_direccion.value = "";
            Proveedor.view.formData.proveedor_telefono.value = "";
            Proveedor.view.formData.proveedor_celular.value = "";
            Proveedor.view.formData.proveedor_email.value = "";
            Proveedor.view.formData.proveedor_ruc.value = "";
        },
        showMsg: (txt) => {
            Proveedor.view.formMsg.innerText = txt;
            setTimeout(() => {
                Proveedor.view.formMsg.innerText = "";
            }, 1000);
        },
        showConfirm: (bool, action) => {
            if (bool) {
                Proveedor.view.sectionModal.classList.add("open");
                Proveedor.view.modalYes.onclick = () => action();
            } else {
                Proveedor.view.sectionModal.classList.remove("open");
            }
        },
        showProgress: (bool, text) => {
            if (bool) {
                Proveedor.view.sectionProgressText.innerText = text;
                Proveedor.view.sectionProgress.classList.add("open");
            } else {
                Proveedor.view.sectionProgressText.innerText = text;
                setTimeout(() => {
                    Proveedor.view.sectionProgress.classList.remove("open");
                    Proveedor.view.sectionProgressText.innerText = "";
                }, 500);
            }
        }
    }
}

ProveedorMain();