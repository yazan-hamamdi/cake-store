function checkout() {

    var form = document.createElement("form");
    form.method = "post";
    form.action = "order.php";
    form.classList.add("submitThisForm");

    var placeOfDeliEle = document.getElementsByClassName("place-of-delivery")[0];
    var placeOfDeliValue = placeOfDeliEle.value;
    // for place of delivery validation
    if (placeOfDeliValue == '') {
        // no need for js code cuz html validation will occur
    } else if (document.getElementsByClassName("counter")[0].innerHTML <= 0) {
        alert("Please choose at least one item")
    } else {
        var place = document.createElement("input");
        var total = document.createElement("input");
        var itemWithQuantity = document.createElement("input");
        itemWithQuantity.name = "itemWithQuantity";
        itemWithQuantity.value = "";
        total.name = "total";
        total.value = parseInt((document.getElementsByClassName("total-result")[0]).innerHTML.replace('$', ''));
        place.name = "place";
        place.value = placeOfDeliValue;
        form.appendChild(place);
        form.appendChild(total);

        for (var i = 0; i < document.getElementsByClassName("item").length; i++) {
            var name = document.getElementsByClassName("item")[i].getElementsByClassName("itemName")[0].innerHTML;
            var quantity = document.getElementsByClassName("item")[i].getElementsByClassName("item-quantity")[0].value;
            itemWithQuantity.value = itemWithQuantity.value + ` ${name} ${quantity} `;
        }
        form.appendChild(itemWithQuantity);
        document.body.appendChild(form);
        form.submit();
    }
}