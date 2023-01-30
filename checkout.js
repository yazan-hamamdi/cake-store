function checkout() {

    var form = document.createElement("form");
    form.method = "post";
    form.action = "order.php";
    form.classList.add("submitThisForm");

    var placeOfDeliEle = document.getElementsByClassName("place-of-delivery")[0];
    var placeOfDeliValue = placeOfDeliEle.value;

    var place = document.createElement("input");
    var total = document.createElement("input");
    var itemWithQuantity = document.createElement("input");
    itemWithQuantity.name = "itemWithQuantity";
    itemWithQuantity.value = "";
    total.name = "total";
    total.value = parseInt((document.getElementsByClassName("total-result")[0]).innerHTML.replace('$', ''));
    if (total.value == NaN) {
        window.open("www.google.com");
    }
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