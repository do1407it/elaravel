@extends('admin-layout')
@section('admin-content')

<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm vận chuyển
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" action="" method="POST">
                        {{csrf_field()}}
                        <?php
                        //Lấy message
                        $message = Session::get('message');

                        if ($message) {
                            echo '<span class="text-alert">' . $message . '</span>';
                            Session::put('message', null);
                        }
                        ?>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn thành phố</label>
                            <select id="city" name="city" class="form-control m-bot15 choose city">
                                @foreach($city as $key => $value)
                                <option value="{{$value->matp}}">{{$value->name_city}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn quận huyện</label>
                            <select id="province" name="province" class="form-control m-bot15 choose province">
                                <option value="">--Chọn--</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword1">Chọn xã phường</label>
                            <select id="wards" name="wards" class="form-control m-bot15 wards">
                                <option value="">--Chọn--</option>

                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Phí vận chuyển</label>
                            <input type="text" class="form-control fee_ship" name="fee_ship">
                        </div>

                        <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>
                    </form>
                </div>
                <div id="load_delivery">

                </div>
            </div>
        </section>

    </div>


</div>
<!-- <script>
    CKEDITOR.replace('brand_product_desc');
</script> -->
<script type="text/javascript">
    $(document).ready(function() {
        function fetch_delivery() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/select-feeship')}}',
                method: 'post',
                data: {
                    _token: _token
                },
                success: function(data) {
                    $('#load_delivery').html(data);
                }

            })
        }
        fetch_delivery();
        $(document).on('blur', '.feeship_edit', function() {
            var feeship_id = $(this).data('feeship_id');
            var fee_price = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{url('/update-delivery')}}',
                method: 'post',
                data: {
                    feeship_id: feeship_id,
                    fee_price: fee_price,
                    _token: _token
                },
                success: function(data) {
                    alert('Update thành công!');
                    fetch_delivery();
                }
            });
        })

        $('.add_delivery').click(function() {
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
            // console.log(city, province, wards, fee_ship);

            $.ajax({
                url: '{{url('/insert-delivery')}}',
                method: 'post',
                data: {
                    city: city,
                    province: province,
                    wards: wards,
                    fee_ship: fee_ship,
                    _token: _token,
                },
                success: function(data) {
                    alert('Thêm thành công!');
                    fetch_delivery();
                }
            });
        });


        $('.choose').on('change', function() {
            // var data = $('form').serialize();
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            if (action == 'city') {
                result = 'province';
            } else {
                result = 'wards';
            }
          
            $.ajax({
                url: '{{url('/select-delivery')}}',
                method: 'post',
                data: {
                    action: action,
                    ma_id: ma_id,
                    _token: _token,
                },
                success: function(data) {
                    $('#' + result).html(data);
                }
            })
        })
    });
</script>
@endsection