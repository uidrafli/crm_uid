var room = 1;

function education_fields() {
  room++;
  var objTo = document.getElementById("education_fields");
  var divtest = document.createElement("div");
  divtest.setAttribute("class", "mb-3 removeclass" + room);
  var rdiv = "removeclass" + room;
  divtest.innerHTML =
    '<form class="row"><div class="col-sm-2"><div class="mb-3"><input type="text" class="form-control" name="description_budget[]" placeholder="Description"></div></div><div class="col-sm-2"> <div class="mb-3"> <input type="text" class="form-control" name="volume[]" placeholder="Volume"> </div></div><div class="col-sm-2"> <div class="mb-3"> <input type="text" class="form-control"" name="unit_cost[]" placeholder="Unit Cost"> </div></div><div class="col-sm-2"> <div class="mb-3"> <input class="form-control" name="total_idr[]" placeholder="Total Amount (IDR)"> </div></div><div class="col-sm-3"> <div class="mb-3"> <input class="form-control" name="total_usd"[] placeholder="Total Amount (USD)"> </div></div><div class="col-sm-1"> <div class="mb-3"> <button class="btn rounded-pill px-4 btn-light-danger text-danger font-weight-medium waves-effect waves-light" type="button" onclick="remove_education_fields(' +
    room +
    ');"> <i class="ri-delete-bin-line fs-5"></i> </button> </div></div></form>';

  objTo.appendChild(divtest);
  feather.replace();
}

function remove_education_fields(rid) {
  $(".removeclass" + rid).remove();
}
