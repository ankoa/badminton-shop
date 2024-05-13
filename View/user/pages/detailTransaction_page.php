 <script> var ID = "<?php 
    if(isset($_GET['id'])) {
        $orderId = $_GET['id'];
        echo $orderId;
    } ?>"; 
</script>
<!--<style>
    .order-container { 
        max-width: 800px; 
        margin: 20px auto; 
        background: white; 
        border-radius: 8px; 
        box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
        padding: 20px; 
    }
    
    .header { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        margin-bottom: 20px; 
    }

    .close-button { 
        background: none; 
        border: none; 
        font-size: 24px; 
        cursor: pointer; 
    } 

    .order-details {
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
    } 

    .product-info { 
        display: flex;
        align-items: center; 
    } 

    .product-info img { 
        margin-right: 15px; 
    } 

    .price-info { 
        font-size: 18px;
        font-weight: bold; 
    } 

    .total { 
        text-align: right; 
        margin-top: 20px; 
    }
</style>


<div class="order-container">
    <div class="header">
        <h1>Đặt hàng thành công</h1>
        <button class="close-button">X</button>
    </div>
    <div id="order-detail-modal"></div>
</div> -->
