$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    function askForApproval(title, text) {
        if(Notification.permission === "granted") {
            createNotification(title, text, '/img/ripperoni-1.png');
        }
        else {
            Notification.requestPermission(permission => {
                if(permission === 'granted') {
                    createNotification(title, text, searchPath + '/img/ripperoni-1.png')
                }
            });
        }
    }

    function createNotification(title, text, icon) {
        console.log('here');
        const noti = new Notification(title, {
            body: text,
            icon
        });
    }

    // askForApproval('Once', 'Once');
    setInterval(function () {
        $.ajax({
            url: searchPath + "notifications",
            type: "GET",
            success: function (data) {
                messages = JSON.parse(data)
                if (messages.length !== 0) {
                    messages.forEach(function(message) {
                        data = message.data;
                        console.log(data);
                        if (data.status !== "") {
                            askForApproval('Order Status Updated', `Order n. ${data.order}: ${data.status}`);
                        }
                        if (data.type === 'forCustomer'){
                            askForApproval('Checkout Confirmed', `The new order it's added lo the list (id ${data.order})`);
                        }
                        if (data.type === 'forSeller'){
                            askForApproval('New order!!', `ggg (id ${data.order})`);
                        }
                    });
                    // askForApproval('10', 'ciao');
                }
            }
        })
    }, 1000);
    // end of ajax call
});
