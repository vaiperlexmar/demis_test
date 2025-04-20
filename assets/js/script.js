'use strict';

function displayUsers(users) {
    const headers = ["Id", "Name", "Address", "Email", "Phone"];
    const table = document.createElement("TABLE");  //makes a table element for the page

    for (let i = 0; i < users.length; i++) {
        const row = table.insertRow(i);
        row.insertCell(0).innerHTML = users[i].id;
        row.insertCell(1).innerHTML = users[i].name;
        row.insertCell(2).innerHTML = users[i].address;
        row.insertCell(3).innerHTML = users[i].email;
        row.insertCell(4).innerHTML = users[i].phone;
    }

    const header = table.createTHead();
    const headerRow = header.insertRow(0);
    for (let i = 0; i < headers.length; i++) {
        headerRow.insertCell(i).innerHTML = headers[i];
    }

    const tableContainer = document.createElement("div");
    tableContainer.className = "table__container";

    tableContainer.append(table);

    document.body.append(tableContainer);
}

$("#feedback-form").submit(function (e) {

    e.preventDefault(); // avoid to execute the actual submit of the form.

    // очищаем старые ошибки
    $(".error").text("");

    const form = $(this);
    const actionUrl = form.attr('action');

    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function (response) {
            if (response.success) {
                form[0].reset();
                $.get("/feedback", function (data) {
                    if (Array.isArray(data) && data.length > 0) {
                        displayUsers(data);
                    }
                });
            } else {
                for (const field of response.errors) {
                    $(`error__${field}`).textContent(response.errors[field]);
                }
            }
        },
        error: function () {
            alert(`Ошибка при отправке формы`)
        }
    });

});