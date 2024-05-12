function getUserID(user) {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: '../Controllers/UserController.php',
            method: 'POST',
            data: { action: 'get', user },
            dataType: 'JSON',
            success: order => resolve(order),
            error: (xhr, status, error) => reject(error)
        })
    })
}