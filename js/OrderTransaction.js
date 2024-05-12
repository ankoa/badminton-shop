function getOrderTransaction(id_transaction) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/OrderTransactionController.php',
            method: 'POST',
            data: { action: 'get-cthd', id_transaction },
            dataType: 'JSON',
            success: cthd => resolve(cthd),
            error: (xhr, status, error) => reject(error)
        })
    })
}

o push code len kieu j  v???