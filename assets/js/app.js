// assets/js/app.js

require('../css/app.css');

const { Payment } = require('ecommpay');

// TODO так не делать
const signer = require('../../node_modules/ecommpay/src/signer');

let params = {
    project_id: '402',
    payment_currency: 'RUB',
    baseUrl: 'http://pp.terminal.test',
};

payBtn.onclick = function () {
    let changedParams = {
        payment_id: document.getElementById('payment_id').value,
        payment_amount: document.getElementById('amount').value,
    };

    let signatureParams = Object.assign(changedParams, params);

    const signature = signer(signatureParams, 'test');

    EPayWidget.run(Object.assign({signature: signature}, signatureParams));
    return false;
};