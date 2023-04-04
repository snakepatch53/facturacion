let BodegaMain = async () => {
    await Bodega.crud.selectProducto();
    await Bodega.crud.select();
    Bodega.view.inputNewButton.onclick = () => Bodega.fun.showForm(true, 0);
    Bodega.view.formButtonCancel.onclick = () => Bodega.fun.showForm(false, 0);
    Bodega.view.formButtonSave.onclick = () => Bodega.fun.submitForm();
    Bodega.view.modalNo.onclick = () => Bodega.fun.showConfirm(false, null);
    Bodega.view.modalClose.onclick = () => Bodega.fun.showConfirm(false, null);
    Bodega.view.inputSearch.onkeyup = () => Bodega.fun.search();
    Bodega.view.selectReport.onchange = () => {
        let select = Bodega.view.selectReport;
        switch(select.value) {
            case 'pdf':
                window.open('estanteria/pdf');
                break;
            case 'excel':
                window.open('estanteria/excel');
                break;
            case 'csv':
                window.open('estanteria/csv');
                break;
        }
        select.value = "";
    }
}

let Bodega = {
    databaseBodega: [],
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
            await fetch_query(null, "bodega", "select").then(res => {
                Bodega.databaseBodega = res;
                Bodega.fun.loadTable(res);
                Bodega.fun.showForm(false, 0);
            }).catch(res => console.log("Error de conexión: " + res));
        },
        insert: () => {
            Bodega.fun.showProgress(true, "Guardando nueva estantería...");
            let formData = new FormData(Bodega.view.formData);
            fetch_query(formData, "bodega", "insert").then(res => {
                Bodega.crud.select();
                Bodega.fun.showProgress(false, "Estantería guardada!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        update: () => {
            Bodega.fun.showProgress(true, "Actualizando la estantería...");
            let formData = new FormData(Bodega.view.formData);
            fetch_query(formData, "bodega", "update").then(res => {
                Bodega.crud.select();
                Bodega.fun.showProgress(false, "Estantería actualizada!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        delete: (bodega_id) => {
            Bodega.fun.showProgress(true, "Eliminando la estantería...");
            let formData = new FormData(Bodega.view.formData);
            formData.append("bodega_id", bodega_id);
            fetch_query(formData, "bodega", "delete").then(res => {
                Bodega.crud.select();
                Bodega.fun.showProgress(false, "Estantería eliminada!");
            }).catch(res => console.log("Error de conexión: " + res));
        },
        selectProducto: async () => {
            await fetch_query(null, "producto", "select").then(res => {
                Bodega.databaseProducto = res;
            }).catch(res => console.log("Error de conexión: " + res));
        },
    },
    fun: { 
        loadTable: (array) => {
            let html = '';
            for (let i of array) {
                let deleteable = isDeleteable(Bodega.databaseProducto, i.bodega_id, "bodega_id");
                html += `
                    <tr>
                        <td><span class="td-span">${ i.bodega_nombre }</span></td>
                        <td><span class="td-span">${ i.bodega_descripcion }</span></td>
                        <td class="td-action">
                            <div class="buttons-flex">
                                <button class="edit ideabutton" onclick="Bodega.fun.showForm(true, ${ i.bodega_id })">
                                    <img src="view/src/icon/edit.png">
                                    <span>Editar</span>
                                </button>
                                <button class="delete ideabutton ${ !deleteable ? "disabled" : "" }" onclick="Bodega.fun.showConfirm(true, () => Bodega.crud.delete(${ i.bodega_id }))" ${ !deleteable ? "disabled" : "" }>
                                    <img src="view/src/icon/delete.png">
                                    <span>Eliminar</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            }
            Bodega.view.tableData.innerHTML = html;
        },
        showForm: (bool, bodega_id) => {
            if (bool) {
                Bodega.view.sectionHead.classList.remove("open");
                Bodega.view.sectionTable.classList.remove("open");
                Bodega.view.sectionModal.classList.remove("open");
                Bodega.view.sectionForm.classList.add("open");
                if (bodega_id != 0) {
                    let bodega = Bodega.databaseBodega.find(element => element.bodega_id == bodega_id);
                    Bodega.view.formData.bodega_id.value = bodega.bodega_id;
                    Bodega.view.formData.bodega_nombre.value = bodega.bodega_nombre;
                    Bodega.view.formData.bodega_nombre_view.value = bodega.bodega_nombre;
                    Bodega.view.formData.bodega_descripcion.value = bodega.bodega_descripcion;
                }
            } else {
                Bodega.view.sectionHead.classList.add("open");
                Bodega.view.sectionTable.classList.add("open");
                Bodega.view.sectionModal.classList.remove("open");
                Bodega.view.sectionForm.classList.remove("open");
                Bodega.fun.clearForm();
            }
        },
        submitForm: () => {
            if (
                Bodega.view.formData.bodega_nombre.value != ""
            ) {

                if (Bodega.view.formData.bodega_id.value == 0) {
                    Bodega.crud.insert();
                } else {
                    Bodega.crud.update();
                }
            } else {
                Bodega.fun.showMsg("Debe llenar todos los campos!");
            }
        },
        search: () => {
            let txt = Bodega.view.inputSearch.value.toLowerCase();
            if (txt.trim() == "") {
                Bodega.fun.loadTable(Bodega.databaseBodega);
            } else {
                let array = [];
                for (let i of Bodega.databaseBodega) {
                    if (
                        txt == i.bodega_nombre.substring(0, txt.length).toLowerCase() ||
                        txt == i.bodega_descripcion.substring(0, txt.length).toLowerCase()
                    ) {
                        array.push(i);
                    }
                }
                Bodega.fun.loadTable(array);
            }
        },
        // CAPSULA DE FUNCIONES
        clearForm: () => {
            Bodega.view.formData.bodega_id.value = 0;
            Bodega.view.formData.bodega_nombre_view.value = "Nuevo";
            Bodega.view.formData.bodega_nombre.value = "";
            Bodega.view.formData.bodega_descripcion.value = "";
        },
        showMsg: (txt) => {
            Bodega.view.formMsg.innerText = txt;
            setTimeout(() => {
                Bodega.view.formMsg.innerText = "";
            }, 1000);
        },
        showConfirm: (bool, action) => {
            if (bool) {
                Bodega.view.sectionModal.classList.add("open");
                Bodega.view.modalYes.onclick = () => action();
            } else {
                Bodega.view.sectionModal.classList.remove("open");
            }
        },
        showProgress: (bool, text) => {
            if (bool) {
                Bodega.view.sectionProgressText.innerText = text;
                Bodega.view.sectionProgress.classList.add("open");
            } else {
                Bodega.view.sectionProgressText.innerText = text;
                setTimeout(() => {
                    Bodega.view.sectionProgress.classList.remove("open");
                    Bodega.view.sectionProgressText.innerText = "";
                }, 500);
            }
        },
    }
}

BodegaMain();