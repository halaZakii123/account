var v = [...document.querySelectorAll('input[type="currency"]')];

v.forEach(function (item) {
    item.addEventListener('focus', onFocus)
    item.addEventListener('blur', onBlur)
    item.addEventListener('change',onChange)
    onBlur({ target: item })
});

var currency = 'SYP' // https://www.currency-iso.org/dam/downloads/lists/list_one.xml

function localStringToNumber(s) {
    return Number(String(s).replace(/[^0-9.-]+/g, ""))
}

function onFocus(e) {
    var value = e.target.value;
    e.target.value = value ? localStringToNumber(value) : '';
}

function onBlur(e) {
    var value = e.target.value

    var options = {
        maximumFractionDigits: 2,
        currency: currency,
        style: "decimal",
        currencyDisplay: "symbol"
    }

    e.target.value = (value || value === 0)
        ? localStringToNumber(value).toLocaleString(undefined, options)
        : '';
    console.log(e);
}

function onChange(e) {
    e.target.parentElement.getElementsByClassName('num').value = localStringToNumber(e.target.value);
}

function setv(e) {
    e.target.parentElement.getElementsByClassName('num').value = localStringToNumber(e.target.value);
}
