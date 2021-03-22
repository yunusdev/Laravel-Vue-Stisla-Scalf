<template>
    <div class="col-lg-4">
        <aside class="user-info-wrapper">
            <div class="user-cover" style="background-image: url(img/account/user-cover-img.jpg);">
                <div class="info-label" data-toggle="tooltip" title="You currently have 290 Reward Points to spend"><i class="icon-medal"></i>290 points</div>
            </div>
            <div class="user-info">
                <div class="user-avatar"><a class="edit-avatar" href="#"></a><img src="img/account/user-ava.jpg" alt="User"></div>
                <div class="user-data">
                    <h4>Daniel Adams</h4><span>Joined February 06, 2017</span>
                </div>
            </div>
        </aside>
        <nav class="list-group">
            <a class="list-group-item with-badge active" href="/account/orders">
                <i class="icon-bag"></i>Orders<span class="badge badge-primary badge-pill">6</span>
            </a>
            <a class="list-group-item" href="/account/profile">
                <i class="icon-head"></i>Profile
            </a>
            <a class="list-group-item" href="account-address.html"><i class="icon-map"></i>Addresses
            </a>
            <a class="list-group-item with-badge" href="account-wishlist.html">
                <i class="icon-heart"></i>Wishlist<span class="badge badge-primary badge-pill">3</span>
            </a>
            <a class="list-group-item with-badge" href="account-tickets.html">
                <i class="icon-tag"></i>My Tickets<span class="badge badge-primary badge-pill">4</span></a></nav>
    </div>
</template>

<script>
export default {
name: "NavAccount"
}
</script>

<style scoped>

</style>
