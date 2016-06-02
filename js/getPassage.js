/**
 * Created by Wilson on 5/21/2016.
 */
function getPassage(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
          var result = JSON.parse(xmlhttp.responseText);
          document.getElementById("displayPassage").innerHTML = result.content;
      }
    };
    xmlhttp.open("GET","../bitdwilson/getPassage.php?pid=1",true);
    xmlhttp.send();


}