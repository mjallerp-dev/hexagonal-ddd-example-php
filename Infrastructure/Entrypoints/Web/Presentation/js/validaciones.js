/**
 * Solicita confirmación antes de enviar un formulario de eliminación.
 *
 * El formulario debe incluir el atributo `data-name` con el nombre del
 * elemento a eliminar y, opcionalmente, `data-type` con su tipo
 * (por defecto "usuario"), por ejemplo:
 *   <form ... onsubmit="return confirmDelete(this);" data-name="Juan">
 *   <form ... onsubmit="return confirmDelete(this);" data-type="artículo" data-name="Portátil">
 *
 * @param {HTMLFormElement} form
 * @returns {boolean}
 */
function confirmDelete(form) {

    var name = form.getAttribute('data-name');
    var type = form.getAttribute('data-type') || 'usuario';
    return confirm('¿Eliminar el ' + type + ' ' + name + '?');
}
