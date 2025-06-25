@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
      <h2 class="page-title">Akunku</h2>
      <div class="row">
        <div class="col-lg-3">
            @include('user.account-nav')
        </div>
        <div class="col-lg-9">
          <div class="page-content my-account__dashboard">
             <strong>Selamat datang! terimakasih sudah percaya pada PT Cakrawala langit Persada</strong></p>
            <p>Kepercayaan Anda adalah kehormatan bagi kami, dan komitmen kami adalah memberikan pelayanan terbaik, solusi terpercaya, serta hasil yang melebihi harapan. Dengan pengalaman dan dedikasi tinggi, kami siap menjadi mitra strategis dalam mewujudkan visi Anda. Mari bersama melangkah menuju masa depan yang lebih cerah dan penuh pencapaian.</p>
          </div>
        </div>
      </div>
    </section>
  </main>
@endsection

