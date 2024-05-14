<style>
    .orders-container {
        width: 100%;
        height: 100%;
        display: grid;
        justify-content: center; /* căn giữa theo chiều ngang */
        align-items: center; /* căn giữa theo chiều dọc */
        padding: 50px 25px;
    }

    .orders-title {
        padding: 30px 45px;
        text-align: center;
    }

    .orders-list {
        width: 500px;
    }

    .order-item {
        display: flex;
        flex-direction: column; /* Xếp chồng các phần tử dọc theo nhau */
        border-bottom: 1px solid black;
        margin-bottom: 20px;
    }

    .order-info {       
        margin-top: -15px;
    }

    .order-item:last-child {
        border-bottom: none;
    }

    .order-details {
        display: flex;
        justify-content: space-between; /* căn giữa theo chiều ngang và để các phần tử cách xa nhau */
        align-items: center; /* căn giữa theo chiều dọc */
    }

    .order-id {
        font-weight: bold;
    }

    .order-total {
        display: inline-block;
        margin-bottom: 20px;
        margin-top: -15px;
    }

    .order-restore-btn {
        width: 70px;
        height: 50px; /* Cao tự động theo nội dung */
        align-self: flex-start; /* căn nút "Restore" lên trên */
        padding: 0;
    }

</style>

<div class="orders-container">
  <h2 class="orders-title">Cancelled Orders</h2>
  <ul class="orders-list">
    <li class="order-item">
        <div class="order-details">
            <div class="order-info">
                <span class="order-id">Order #12345</span> - Cancelled on 2022-01-15
            </div>
            <button class="order-restore-btn">Restore</button>
        </div>
        <div class="order-total">Total: $50.00</div>
    </li>
    <li class="order-item">
        <div class="order-details">
            <div class="order-info">
                <span class="order-id">Order #67890</span> - Cancelled on 2022-02-20
            </div>
            <button class="order-restore-btn">Restore</button>
        </div>
        <div class="order-total">Total: $75.00</div>
    </li>
</ul>
</div>