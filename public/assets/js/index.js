"use strict";

$(document).ready(function() {
  /* Function to Search for a specific column. */

  $(".notfound").hide();
  function myFunction() {
    $(".notfound").hide();

    let input, filter, table, tr, td, i;
    input = document.getElementById("searchUserName");
    filter = input.value.toUpperCase();
    table = document.getElementById("TBUsersList");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
      td = tr[i].getElementsByTagName("td")[3];
      if (td) {
        if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
          tr[i].style.display = "";

          $(".notfound").hide();
        } else {
          tr[i].style.display = "none";

          $(".notfound").show();
        }
      }
    }
  }

  /* Search Input*/
  $("#searchUserName").keyup(function() {
    /* Function that Filter's the User Name. */
    myFunction();
  });
});
