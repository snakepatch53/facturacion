config = {
    protocol: "http",
    host: "localhost",
    proyect: "facturacion",
    getUrl: () => {
        //return `${ config.protocol }://${ config.host }/${ config.proyect }/`;
        // return `https://asistencia.moronanet.com/`;
        return `http://localhost/old/facturacion/`;
    },
};

let fetch_query = (formData, entity, operation) => {
    return fetch(`${config.getUrl()}model/script/${entity}/${operation}.php`, {
        method: "POST",
        headers: new Headers().append("Accept", "application/json"),
        body: formData,
    })
        .then((res) => res.json())
        .then((res) => res);
};
