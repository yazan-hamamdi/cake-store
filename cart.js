var cartItems = document.getElementsByClassName("items")[0];
cartItems.classList.add("items");
var flag = 0;

var buttons = document.getElementsByClassName("addToCart");
for (let i = 0; i < buttons.length; i++) {
    let button = buttons[i];
    button.addEventListener("click", function () {
        document.getElementsByClassName("counter")[0].innerHTML = parseInt(document.getElementsByClassName("counter")[0].innerHTML) + 1;
        var cartList = document.getElementsByClassName("cart-list")[0];
        cartList.classList.add("display-block");
        cartList.classList.remove("display-none");
        createElementsInsideCart(button)
    })
}

function createElementsInsideCart(button) {
    var cartItem = document.createElement("div");
    cartItem.classList.add("item");
    var cartItemImage = document.createElement("div");
    cartItemImage.classList.add("item-image");
    var theImage = document.createElement("img");
    theImage.src = button.parentElement.firstElementChild.src;
    cartItemImage.appendChild(theImage);
    cartItem.appendChild(cartItemImage);
    var itemPrice = document.createElement("div")
    itemPrice.classList.add("item-price");
    cartItem.appendChild(itemPrice);
    itemPrice.innerHTML = button.parentElement.children[2].innerHTML;
    var itemQuantity = document.createElement("input");
    itemQuantity.classList.add("item-quantity");
    itemQuantity.type = "number";
    itemQuantity.min = "1";
    itemQuantity.value = 1;
    itemQuantity.onchange = function () {
        calculateTheTotal();
    };
    cartItem.appendChild(itemQuantity);
    var removeBtn = document.createElement("div");
    removeBtn.classList.add("remove-items");
    removeBtn.innerHTML = "Remove";
    removeBtn.onclick = function () {
        deleteItem(removeBtn);
    };
    var itemInfo = document.createElement("div");
    itemInfo.classList.add("item-info");
    var itemName = document.createElement("div");
    itemName.classList.add("itemName");
    itemName.style.display = "none";
    itemName.innerHTML = button.parentElement.children[1].children[0].innerHTML;
    itemInfo.appendChild(itemName);
    cartItem.appendChild(removeBtn);
    cartItem.appendChild(itemInfo);
    cartItems.appendChild(cartItem);
    if (flag == 0) {
        flag++;
        document.getElementById("cartForm").appendChild(cartItems);
    }
    calculateTheTotal();
}



function calculateTheTotal() {
    var result = 0;
    var items = document.getElementsByClassName("items")[0];
    for (var i = 3; i < items.childElementCount; i++) {
        var exactItem = items.children[i].children[1];
        result = result + parseInt(exactItem.innerHTML.replace('$', '') * items.children[i].children[2].value);
    }
    document.getElementsByClassName("total-result")[0].innerHTML = "$" + result;
}

function deleteItem(removeBtn) {
    removeBtn.parentElement.remove();
    document.getElementsByClassName("counter")[0].innerHTML = parseInt(document.getElementsByClassName("counter")[0].innerHTML) - 1;
    calculateTheTotal();
}



var Cart = document.getElementsByClassName("cart")[0];
Cart.addEventListener("click", function () {
    var element = document.getElementsByClassName("cart-list")[0];
    if (element.classList.contains("display-none")) {
        element.classList.remove("display-none");
        element.classList.add("display-block");
    }
    else {
        element.classList.add("display-none");
        element.classList.remove("display-block");
    }
})