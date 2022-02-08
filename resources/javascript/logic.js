        
// Both JS functions are to make the site wide Blue or red form drop downs work.
// https://www.w3schools.com/howto/howto_js_collapsible.asp cited here as well as in the CSS file

//Regular blue collapsibles
function collapse(j){

    // Get all the collapsible elements
    var coll = document.getElementsByClassName('collapsible');

    // Find the collapsible element from given index j 
    var collapsible = coll[j];

    // nextElementSibling gets the next element
    // The next element is the form that starts hidden
    var content = collapsible.nextElementSibling;

    // This displays or hides the form depening on its current state 
    if (content.style.display === "block") {
        content.style.display = "none";
        collapsible.className="collapsible";
    } else {
            content.style.display = "block";
            collapsible.className="collapsible extra";
    }


    
}

//Admin red collapsibles
function admincollapse(j){

    // Get all the collapsible elements
    var coll = document.getElementsByClassName('admincollapsible');

    // Find the collapsible element from given index j 
    var collapsible = coll[j];

    // nextElementSibling gets the next element
    // The next element is the form that starts hidden
    var content = collapsible.nextElementSibling;

    // This displays or hides the form depening on its current state 
    if (content.style.display === "block") {
        content.style.display = "none";
        collapsible.className="admincollapsible";
    } else {
            content.style.display = "block";
            collapsible.className="admincollapsible extra";
    }


    
}