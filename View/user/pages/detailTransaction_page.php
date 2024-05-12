
<div id="detailModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeDetailModal()">&times;</span>
        <iframe id="detailFrame" src="" frameborder="0"></iframe>
        <div class="order-container">
            <div class="header">
                <h1>Đặt hàng thành công</h1>
                <button class="close-button">X</button>
            </div>
            <div id="order-detail-modal"></div>
        </div>
    </div>
</div>

<script>
    function openDetailModal(orderId) {
        var modal = document.getElementById("detailModal");
        var detailFrame = document.getElementById("detailFrame");
        detailFrame.src = "detail.php?id=" + orderId;
        modal.style.display = "block";
    }

    // Đóng modal
    function closeDetailModal() {
        var modal = document.getElementById("detailModal");
        modal.style.display = "none";
    }
</script>