"use strict";

/////////////////////////////////////////////////////////////////////////////////////////
// FUNCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////

function quickSearch() {
  const query = document.querySelector('input[name="search-str"]').value;

  if (query.length < 3) {
    document.querySelector("#table-target").innerHTML = "";
    return;
  } else {
    search(query);
  }
}

function search(query) {
  let url = "http://127.0.0.1:8000/admin/dashboard/quick-search";
  const regexOnlyNumberAndPlus = /^[0-9]+$/;
  const regexOnlyLetterAndSpace = /^[a-zA-Z\s]*$/;
  document.querySelector("#table-target").innerHTML = "";

  if (regexOnlyLetterAndSpace.test(query) === true) {
    url += "-name/";
  } else if (regexOnlyNumberAndPlus.test(query) === true) {
    url += "-number/";
  } else {
    window.alert(`Your search "${query}" shoud be a number or a name`);
    return;
  }

  fetch(url + query)
    .then((response) => response.json())
    .then((json) => {
      console.log(json);
      displayContacts(json);
    });
}

function displayContacts(json) {
  let target = document.querySelector("#table-target");

  target.innerHTML = "";
  json.forEach((element, index) => {
    target.insertAdjacentHTML(
      "beforeend",
      `<tr class="table-primary">
        <td>
        <a href="/admin/contact/${element.id}"> ${element.firstName} ${element.lastName} </a>
        </td>
        <td> ${element.phone} </td>
        <td> ${element.email} </td>
        <td>
        <a href="/admin/contact/${element.id}/edit">
        <i class="fa fa-edit"></i>
        </a>
        <a href="/admin/contact/${element.id}/delete">
        <i class="fa fa-trash"></i>
        </a>
        </td>
        </tr>`
    );
  });
}

/////////////////////////////////////////////////////////////////////////////////////////
// PRINCIPAL CODE                                                                  //
/////////////////////////////////////////////////////////////////////////////////////////
document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelector("#quick-search")
    .addEventListener("submit", (event) => {
      event.preventDefault();
    });
  document
    .querySelector('input[name="search-str"]')
    .addEventListener("keyup", quickSearch);
});
