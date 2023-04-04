let ClienteMain = async () => {
    await Cliente.crud.selectProductoVenta();
    await Cliente.crud.select();
    Cliente.view.inputNewButton.onclick = () => Cliente.fun.showForm(true, 0);
    Cliente.view.formButtonCancel.onclick = () => Cliente.fun.showForm(false, 0);
    Cliente.view.formButtonSave.onclick = () => Cliente.fun.submitForm();
    Cliente.view.modalNo.onclick = () => Cliente.fun.showConfirm(false, null);
    Cliente.view.modalClose.onclick = () => Cliente.fun.showConfirm(false, null);
    Cliente.view.inputSearch.onkeyup = () => Cliente.fun.search();
    Cliente.view.selectReport.onchange = () => {
        let select = Cliente.view.selectReport;
        switch (select.value) {
            case 'pdf':
                window.open('cliente/pdf');
                break;
            case 'excel':
                window.open('cliente/excel');
                break;
            case 'csv':
                window.open('cliente/csv');
                break;
        }
        select.value = "";
    }
}

let Cliente = {
    databaseCliente: [],
    databaseProducto_venta: [],
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
        buttonShowPass: document.getElementById("buttonShowPass"),
        imgShowPass: document.getElementById("imgShowPass"),
        sectionProgress: document.getElementById("sectionProgress"),
        sectionProgressText: document.getElementById("sectionProgressText")
    },
    crud: {
        select: async () => {
            await fetch_query(null, "cliente", "select").then(res => {
                Cliente.databaseCliente = res;
                Cliente.fun.loadTable(res);
                Cliente.fun.showForm(false, 0);
            }).catch(res => console.log("Error de conexión: " + res));
        },
        insert: () => {
            Cliente.fun.showProgress(true, "Guardando nuevo cliente...");
            let formData = new FormData(Cliente.view.formData);
            fetch_query(formData, "cliente", "insert").then(res => {
                Cliente.crud.select();
                Cliente.fun.showProgress(false, "Cliente guardado!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        update: () => {
            Cliente.fun.showProgress(true, "Actualizando el cliente...");
            let formData = new FormData(Cliente.view.formData);
            fetch_query(formData, "cliente", "update").then(res => {
                Cliente.crud.select();
                Cliente.fun.showProgress(false, "Cliente actualizado!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        delete: (cliente_id) => {
            Cliente.fun.showProgress(true, "Eliminando el cliente...");
            let formData = new FormData(Cliente.view.formData);
            formData.append("cliente_id", cliente_id);
            fetch_query(formData, "cliente", "delete").then(res => {
                Cliente.crud.select();
                Cliente.fun.showProgress(false, "Cliente eliminado!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        selectProductoVenta: async () => {
            await fetch_query(null, "producto_venta", "select").then(res => {
                Cliente.databaseProducto_venta = res;
            }).catch(res => console.log("Error de conexión: " + res));
        },
    },
    fun: {
        loadTable: (array) => {
            let html = '';
            for (let i of array) {
                let deleteable = isDeleteable(Cliente.databaseProducto_venta, i.cliente_id, "cliente_id");
                html += `
                    <tr>
                        <td><span class="td-span">${ i.cliente_nombre1 } ${ i.cliente_apellido1 }</span></td>
                        <td><span class="td-span">${ i.cliente_cedula != "" ? i.cliente_cedula : i.cliente_ruc }</span></td>
                        <td><span class="td-span">${ i.cliente_direccion }</span></td>
                        <td><span class="td-span">${ i.cliente_celular } ${ i.cliente_telefono.trim() != "" ? " / "+i.cliente_telefono : "" } </span></td>
                        <td class="td-action">
                            <div class="buttons-flex">
                                <button class="edit ideabutton" onclick="Cliente.fun.showForm(true, ${ i.cliente_id })">
                                    <img src="view/src/icon/edit.png">
                                    <span>Editar</span>
                                </button>
                                <button class="delete ideabutton ${ !deleteable ? "disabled" : "" }" onclick="Cliente.fun.showConfirm(true, () => Cliente.crud.delete(${ i.cliente_id }))" ${ !deleteable ? "disabled" : "" }>
                                    <img src="view/src/icon/delete.png">
                                    <span>Eliminar</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }
            Cliente.view.tableData.innerHTML = html;
        },
        showForm: (bool, cliente_id) => {
            if (bool) {
                Cliente.view.sectionHead.classList.remove("open");
                Cliente.view.sectionTable.classList.remove("open");
                Cliente.view.sectionModal.classList.remove("open");
                Cliente.view.sectionForm.classList.add("open");
                if (cliente_id != 0) {
                    let cliente = Cliente.databaseCliente.find(element => element.cliente_id == cliente_id);
                    Cliente.view.formData.cliente_id.value = cliente.cliente_id;
                    Cliente.view.formData.cliente_nombre_view.value = cliente.cliente_nombre1 + " " + cliente.cliente_apellido1;
                    Cliente.view.formData.cliente_nombre1.value = cliente.cliente_nombre1;
                    Cliente.view.formData.cliente_nombre2.value = cliente.cliente_nombre2;
                    Cliente.view.formData.cliente_apellido1.value = cliente.cliente_apellido1;
                    Cliente.view.formData.cliente_apellido2.value = cliente.cliente_apellido2;
                    Cliente.view.formData.cliente_cedula.value = cliente.cliente_cedula;
                    Cliente.view.formData.cliente_ruc.value = cliente.cliente_ruc;
                    Cliente.view.formData.cliente_ciudad.value = cliente.cliente_ciudad;
                    Cliente.view.formData.cliente_direccion.value = cliente.cliente_direccion;
                    Cliente.view.formData.cliente_telefono.value = cliente.cliente_telefono;
                    Cliente.view.formData.cliente_celular.value = cliente.cliente_celular;
                    Cliente.view.formData.cliente_email.value = cliente.cliente_email;
                }
            } else {
                Cliente.view.sectionHead.classList.add("open");
                Cliente.view.sectionTable.classList.add("open");
                Cliente.view.sectionModal.classList.remove("open");
                Cliente.view.sectionForm.classList.remove("open");
                Cliente.fun.clearForm();
            }
        },
        submitForm: () => {
            let form = Cliente.view.formData;
            if (
                form.cliente_nombre1.value == "" ||
                form.cliente_nombre2.value == "" ||
                form.cliente_apellido1.value == "" ||
                form.cliente_apellido2.value == "" ||
                form.cliente_ciudad.value == "" ||
                form.cliente_direccion.value == "" ||
                form.cliente_celular.value == "" ||
                form.cliente_email.value == ""
            ) {
                Cliente.fun.showMsg("Debe llenar todos los campos!");
                return;
            } else if (!isCedula(form.cliente_cedula.value) && form.cliente_cedula.value != "") {
                Cliente.fun.showMsg("Número de Cédula no válido!");
                return;
            } else if (!isRuc(form.cliente_ruc.value) && form.cliente_ruc.value != "") {
                Cliente.fun.showMsg("Número de Ruc no válido!");
                return;
            } else if (!isTelefono(form.cliente_telefono.value) && form.cliente_telefono.value != "") {
                Cliente.fun.showMsg("Número de Teléfono no válido!");
                return;
            } else if (!isCelular(form.cliente_celular.value)) {
                Cliente.fun.showMsg("Número de Celular no válido!");
                return;
            } else if (!isEmail(form.cliente_email.value)) {
                Cliente.fun.showMsg("Correo electrónico no válido!");
                return;
            } else if ((form.cliente_cedula.value == "" && form.cliente_ruc.value == "")) {
                Cliente.fun.showMsg("Ingrese el Ruc o la cedula!");
                return;
            } else if (
                (form.cliente_cedula.value != "" && existData(Cliente.databaseCliente, form.cliente_cedula.value, "cliente_cedula", form.cliente_id.value, "cliente_id"))
            ) {
                Cliente.fun.showMsg("Cédula en uso!");
                return;
            } else if (
                (form.cliente_ruc.value != "" && existData(Cliente.databaseCliente, form.cliente_ruc.value, "cliente_ruc", form.cliente_id.value, "cliente_id"))
            ) {
                Cliente.fun.showMsg("Ruc en uso!");
                return;
            }
            if (form.cliente_id.value == 0) {
                Cliente.crud.insert();
            } else {
                Cliente.crud.update();
            }
        },
        search: () => {
            let txt = Cliente.view.inputSearch.value.toLowerCase();
            if (txt.trim() == "") {
                Cliente.fun.loadTable(Cliente.databaseCliente);
            } else {
                let array = [];
                for (let i of Cliente.databaseCliente) {
                    if (
                        txt == i.cliente_nombre1.substring(0, txt.length).toLowerCase() ||
                        txt == i.cliente_nombre2.substring(0, txt.length).toLowerCase() ||
                        txt == i.cliente_apellido1.substring(0, txt.length).toLowerCase() ||
                        txt == i.cliente_apellido2.substring(0, txt.length).toLowerCase() ||
                        txt == i.cliente_cedula.substring(0, txt.length).toLowerCase() ||
                        txt == i.cliente_ruc.substring(0, txt.length).toLowerCase() ||
                        txt == i.cliente_ciudad.substring(0, txt.length).toLowerCase() ||
                        txt == i.cliente_email.substring(0, txt.length).toLowerCase()
                    ) {
                        array.push(i);
                    }
                }
                Cliente.fun.loadTable(array);
            }
        },
        // CAPSULA DE FUNCIONES
        clearForm: () => {
            Cliente.view.formData.cliente_id.value = 0;
            Cliente.view.formData.cliente_nombre_view.value = "Nuevo";
            Cliente.view.formData.cliente_nombre1.value = "";
            Cliente.view.formData.cliente_nombre2.value = "";
            Cliente.view.formData.cliente_apellido1.value = "";
            Cliente.view.formData.cliente_apellido2.value = "";
            Cliente.view.formData.cliente_cedula.value = "";
            Cliente.view.formData.cliente_ruc.value = "";
            Cliente.view.formData.cliente_ciudad.value = "";
            Cliente.view.formData.cliente_direccion.value = "";
            Cliente.view.formData.cliente_telefono.value = "";
            Cliente.view.formData.cliente_celular.value = "";
            Cliente.view.formData.cliente_email.value = "";
        },
        showMsg: (txt) => {
            Cliente.view.formMsg.innerText = txt;
            setTimeout(() => {
                Cliente.view.formMsg.innerText = "";
            }, 1000);
        },
        showConfirm: (bool, action) => {
            if (bool) {
                Cliente.view.sectionModal.classList.add("open");
                Cliente.view.modalYes.onclick = () => action();
            } else {
                Cliente.view.sectionModal.classList.remove("open");
            }
        },
        showProgress: (bool, text) => {
            if (bool) {
                Cliente.view.sectionProgressText.innerText = text;
                Cliente.view.sectionProgress.classList.add("open");
            } else {
                Cliente.view.sectionProgressText.innerText = text;
                setTimeout(() => {
                    Cliente.view.sectionProgress.classList.remove("open");
                    Cliente.view.sectionProgressText.innerText = "";
                }, 500);
            }
        },
    }
}

ClienteMain();