<style type=text/css>

.nav-tabs .nav-item .nav-link {
  color: #F6DB80; }
  .nav-tabs .nav-item .nav-link.active {
    color: #000; }
    .nav-tabs .nav-item .nav-link {
        color: #000;
    }
    .nav-tabs .nav-item.active .nav-link{
        color: black;
        background-color: rgb(207, 207, 207);
    }
    ul.nav-tabs li.active .a.nav-link {
        color: #green;
    }

</style>
<ul class="nav nav-tabs">
    <li class="nav-item {{ (request()->is('admin/booking')) ? 'active' : '' }}"  style="width: 247px;">
      <a class="nav-link" href="{{ route('transaksi') }}" style="text-align:center;">Semua</a>
    </li>
    <li class="nav-item {{ (request()->is('admin/booking/sukses')) ? 'active' : '' }}"  style="width: 247px;">
      <a class="nav-link" href="{{ route('sukses') }}" style="text-align:center;">Sukses</a>
    </li>
    <li class="nav-item {{ (request()->is('admin/booking/menunggu')) ? 'active' : '' }}"  style="width: 247px;">
      <a class="nav-link" href="{{ route('menunggu') }}" style="text-align:center;">Menunggu</a>
    </li>
    <li class="nav-item {{ (request()->is('admin/booking/batal')) ? 'active' : '' }}"  style="width: 247px;">
      <a class="nav-link" href="{{ route('dibatalkan') }}" style="text-align:center;">Dibatalkan</a>
    </li>
</ul>
