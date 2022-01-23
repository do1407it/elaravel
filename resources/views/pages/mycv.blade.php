@extends('layout')
@section('content')
<Style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --facebook-color: #3b5999;
    --instagram-color: #e1306c;
    --youtube-color: #de463b;
    --twitter-color: #46c1f6;
    --github-color: #333;
}

html {
    font-family: 'Fira Sans', sans-serif;
}

a {
    text-decoration: none;
}

.icon-social {
    color: black;
}

body {
    /* background: #58aec3; */
}

.features_items {
    background-color: #58aec3;
    border-radius:16px;
}

h2.title{
    color: black
}

/* Header */

.intro {
    display: flex;
    justify-content: space-between;
    background: linear-gradient(to right bottom, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.3));
    padding: 32px;
    margin-top: 45px;
    border-radius: 16px;
}


/* <!-- Giới thiệu --> */

.intro-user {
    display: flex;
}

.intro-user_title {
    margin-left: 20px;
}

.intro_user-icon-wrap {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 45px;
}

.img-user_img {
    height: 160px;
    width: 160px;
    box-shadow: 0px 4px 7px rgb(0 0 0 / 45%);
    border-radius: 5px;
}

.user-heading {
    margin-top: 15px;
    letter-spacing: 1px;
    font-weight: 700;
}

.user-title {
    opacity: 0.8;
    line-height: 20px;
}

.intro_user-icon-social {
    font-size: 34px;
    color: rgb(21, 97, 110);
}


/* icon social */

.icon {
    margin: 0 20px;
    cursor: pointer;
    position: relative;
}

.icon i {
    height: 40px;
    width: 40px;
    border-radius: 50%;
    background: #fff;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    font-size: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon .tooltip {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    color: #fff;
    padding: 10px 18px;
    font-size: 10px;
    font-weight: 500;
    border-radius: 25px;
    opacity: 0;
    pointer-events: none;
    box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.2);
}

.icon .tooltip:before {
    position: absolute;
    content: '';
    height: 15px;
    width: 15px;
    left: 50%;
    bottom: -6px;
    transform: translateX(-50%) rotate(45deg);
}

.tooltip,
.icon i {
    transition: 0.3s;
}

.icon:hover .tooltip {
    opacity: 1;
    pointer-events: auto;
    top: -40px;
}

.icon:hover i {
    color: white;
}

.facebook .tooltip:before,
.facebook:hover i,
.facebook .tooltip {
    background: var(--facebook-color);
}

.github .tooltip:before,
.github:hover i,
.github .tooltip {
    background: var(--github-color);
}

.instagram .tooltip:before,
.instagram:hover i,
.instagram .tooltip {
    background: var(--instagram-color);
}
.intro{
    border-radius:46px;
}


/* .intro_user-icon-social:hover {
        opacity: 0.8;
        color: rgb(29, 151, 221);
    } */


/* .intro-user::after {
    content: '';
    background-color: #c2c4c5;
    position: absolute;
    top: 7%;
    right: 50%;
    bottom: 0;
    height: 21%;
    width: 1px;
} */


/* <!-- Thông tin --> */

.intro-contact {
    display: flex;
    align-items: center;
    padding-right: 120px;
}

.intro-contact-list {
    margin: 0 20px;
}

.intro-contact-item {
    margin: 20px 0;
    list-style-type: none;
}

.intro-contact_heading {
    text-transform: uppercase;
    font-size: 15px;
    font-weight: 700;
    line-height: 30px;
}

.intro-contact_title {
    font-size: 14px;
}


/* P2 */

.row.container {
    margin-top: 20px;
}


/* options */

.options {
    background: linear-gradient(to right bottom, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.3));
    padding: 30px;
    border-radius: 16px;
    position: fixed;
    width: 180px;
}

.option-item-icon {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.option-item {
    list-style-type: none;
    margin-bottom: 20px;
    cursor: pointer;
}

.option-item:hover {
    opacity: 0.5;
    background-image: linear-gradient(142.17deg, #4f93f177 6.66%, #dd8cec62 91.48%);
    border-radius: 16px;
}

.option-item.active {
    background-image: linear-gradient(142.17deg, #4f93f1 6.66%, #de8cec 91.48%);
    border-radius: 16px;
}


/* pane */

.panes {
    background: linear-gradient(to right bottom, rgba(255, 255, 255, 0.7), rgba(255, 255, 255, 0.3));
    padding: 30px;
    border-radius: 16px;
}

.pane-item {
    list-style-type: none;
}

.pane-heading {
    position: relative;
    margin-bottom: 45px;
}

.pane-heading::before {
    position: absolute;
    content: '';
    height: 5px;
    width: 12%;
    background-image: linear-gradient(142.17deg, #cc2dc4 6.66%, #cead1c 91.48%);
    top: 110%;
    border-radius: 25px;
}

.img-warp {
    overflow: hidden;
    border-radius: 16px;
}

.page-learn_img {
    width: -webkit-fill-available;
    height: 180px;
    border-radius: 16px;
    /* object-fit: cover; */
    object-position: center;
    transition: 0.25s;
}

.page-learn_img:hover {
    transform: scale(1.1);
}

.pane-description {
    margin: 15px 0;
    text-align: justify;
}

.page-learn_list {
    /* display: flex; */
    justify-content: space-between;
}

.page-learn_item {
    list-style-type: none;
}

.page-learn_link {
    text-decoration: none;
}

.page-learn_title {
    text-align: center;
    color: black;
}


/* tabUI */

.pane-item {
    display: none;
}

.pane-item.active {
    display: block;
}


/* pane-item 2 */

.pane-section_wrap {
    margin-bottom: 40px;
}

.pane-section_icon {
    color: #0f7081;
    font-size: 25px;
    margin-right: 12px;
}

.pane-section {
    margin-bottom: 24px;
    line-height: 30px;
    align-items: center;
}

.seft {
    margin-left: 24px;
    margin-bottom: 24px;
    position: relative;
}

.seft-icon {
    position: absolute;
    top: 4px;
    left: -24px;
    font-size: 12px;
    color: blue;
    box-shadow: 0 0 0 0.1875rem rgb(48 76 253 / 25%);
    border-radius: 10px;
}

.seft-heading {
    font-size: 16px;
}

.seft-title {
    font-size: 14px;
    opacity: 0.5;
    margin-bottom: 8px;
}

.seft-text {
    font-size: 16px;
    text-align: justify;
    line-height: 24px;
}
</Style>
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">MY INFO</h2>
    <div class="main">
        <div class="grid wide">
            <div class="row">
                <div class="col l-12">
                    <div class="intro">
                        <!-- Giới thiệu -->
                        <div class="intro-user">
                            <img src="{{URL::to('public/fontend/images/index.jpeg')}}" alt="img-user"
                                class="img-user_img">
                            <div class="intro-user_title">
                                <h2 class="user-heading">Trần Đình Đô</h2>
                                <p class="user-title">Sinh viên (STU)</p>
                                <div class="intro_user-icon-wrap">
                                    <div class="icon facebook">
                                        <a href="https://www.facebook.com/ddoo.td/" class="icon-social"><i
                                                class="icon-social fab fa-facebook-f"></i></a>
                                        <span class="tooltip">Facebook</span>
                                    </div>
                                    <div class="icon github">
                                        <i class="icon-social fab fa-github"></i>
                                        <span class="tooltip">Github</span>
                                    </div>
                                    <div class="icon instagram">
                                        <a href="https://www.instagram.com/ddoo.td/" class="icon-social"><i
                                                class="icon-social fab fa-instagram"></i></a>

                                        <span class="tooltip">Instagram</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Thông tin -->
                        <div class="intro-contact">
                            <ul class="intro-contact-list">
                                <li class="intro-contact-item">
                                    <p class="intro-contact_heading">EMAIL</p>
                                    <p class="intro-contact_title">dotran260@gmail.com</p>
                                </li>
                                <li class="intro-contact-item">
                                    <p class="intro-contact_heading">Số điện thoại</p>
                                    <p class="intro-contact_title">0909***869</p>
                                </li>
                            </ul>
                            <ul class="intro-contact-list">
                                <li class="intro-contact-item">
                                    <p class="intro-contact_heading">DATE</p>
                                    <p class="intro-contact_title">14/07/2000</p>
                                </li>
                                <li class="intro-contact-item">
                                    <p class="intro-contact_heading">Địa chỉ</p>
                                    <p class="intro-contact_title">Việt Nam</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col l-12">
                    <div class="intro">
                        <!-- Giới thiệu -->
                        <div class="intro-user">
                            <img src="{{URL::to('public/fontend/images/Vinh.jpg')}}" alt="img-user"
                                class="img-user_img">
                            <div class="intro-user_title">
                                <h2 class="user-heading">Ngô Gia Vinh</h2>
                                <p class="user-title">Sinh viên (STU)</p>
                                <div class="intro_user-icon-wrap">
                                    <div class="icon facebook">
                                        <a href="https://www.facebook.com/iruno.mysterio" class="icon-social"><i
                                                class="icon-social fab fa-facebook-f"></i></a>
                                        <span class="tooltip">Facebook</span>
                                    </div>
                                    <div class="icon github">
                                        <i class="icon-social fab fa-github"></i>
                                        <span class="tooltip">Github</span>
                                    </div>
                                    <div class="icon instagram">
                                        <a href="https://www.instagram.com/ddoo.td/" class="icon-social"><i
                                                class="icon-social fab fa-instagram"></i></a>

                                        <span class="tooltip">Instagram</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Thông tin -->
                        <div class="intro-contact">
                            <ul class="intro-contact-list">
                                <li class="intro-contact-item">
                                    <p class="intro-contact_heading">EMAIL</p>
                                    <p class="intro-contact_title">giavinh2802@gmail.com</p>
                                </li>
                                <li class="intro-contact-item">
                                    <p class="intro-contact_heading">Số điện thoại</p>
                                    <p class="intro-contact_title">0909***869</p>
                                </li>
                            </ul>
                            <ul class="intro-contact-list">
                                <li class="intro-contact-item">
                                    <p class="intro-contact_heading">DATE</p>
                                    <p class="intro-contact_title">28/02/2000</p>
                                </li>
                                <li class="intro-contact-item">
                                    <p class="intro-contact_heading">Địa chỉ</p>
                                    <p class="intro-contact_title">Việt Nam</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row container">

                <div class="col l-10">
                    <div class="panes">
                        <ul class="panes-list">
                            <!-- Bản thân -->
                            <li class="pane-item active">
                                <h1 class="pane-heading">Giới thiệu</h1>
                                <p class="pane-description">Mình là một sinh viên của trường đại học Công nghệ Sài Gòn.
                                    Mình đang học tập, theo đuổi ngành Công Nghệ Thông Tin.</p>
                                <p class="pane-description">Rât mong được sự giúp đỡ từ các bậc tiền bối để ngày càng
                                    tiến bộ hơn trong ngành Công nghệ thông tin.</p>
                            </li>
                            <li class="pane-item">
                                <h1 class="pane-heading">Học vấn</h1>
                                <div class="pane-section_wrap">
                                    <h2 class="pane-section"><i class="pane-section_icon fas fa-school"></i>Giáo dục
                                    </h2>
                                    <div class="seft">
                                        <i class="seft-icon fas fa-dot-circle"></i>
                                        <h4 class="seft-heading">Trường Đại Học Công nghệ sài gòn</h4>
                                        <p class="seft-title">2018 - nay</p>
                                        <p class="seft-text">Vào học từ 2019 đến nay những năm đầu của sinh viên, học
                                            tập chưa rõ ràng định hướng sẽ làm gì trong ngành nghề này..., cho đến này
                                            tập trung vào con đường Web Developer.</p>
                                    </div>
                                    <div class="seft">
                                        <i class="seft-icon fas fa-dot-circle"></i>
                                        <h4 class="seft-heading">F8</h4>
                                        <p class="seft-title">2/9/2021 - nay</p>
                                        <p class="seft-text">Được biết đến trang Web dạy học của anh Sơn thật sự rất là
                                            tuyệt vời mình học được những kĩ năng kiến thức căn bản đến nâng cao để trở
                                            thành một Web Developer, ở trong đây có một người giáo viên dạy rất tận tâm,
                                            rất là dễ hiểu.</p>
                                    </div>
                                </div>
                                <div class="pane-section_wrap">
                                    <h2 class="pane-section"><i class="pane-section_icon fas fa-horse-head"></i>Kinh
                                        nghiệm</h2>
                                    <div class="seft">
                                        <i class="seft-icon fas fa-dot-circle"></i>
                                        <h4 class="seft-heading">Chạy shiper</h4>
                                        <p class="seft-title">2019 - nay</p>
                                        <p class="seft-text">Gần 500 đơn gần xa trong nước</p>
                                    </div>
                                    <div class="seft">
                                        <i class="seft-icon fas fa-dot-circle"></i>
                                        <h4 class="seft-heading">Ngồi trên ghế nhà trường</h4>
                                        <p class="seft-title">2/9/2021 - nay</p>
                                        <p class="seft-text">Em đã nắm được "sơ sơ" các kiến thức nền tảng của HTML, CSS
                                            và Javascrpit.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="pane-item">
                                <h1 class="pane-heading">Mục tiêu</h1>
                                <div class="pane-section_wrap">
                                    <h2 class="pane-section">
                                        <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js">
                                        </script>
                                        <lord-icon src="https://cdn.lordicon.com/qhgmphtg.json" trigger="loop"
                                            colors="primary:#121331,secondary:#08a88a" style="width:32px;height:32px">
                                        </lord-icon>
                                        Ngắn hạn
                                    </h2>
                                    <div class="seft">
                                        <i class="seft-icon fas fa-dot-circle"></i>
                                        <h4 class="seft-heading">Học và rèn luyện HTMl & Css</h4>
                                        <p class="seft-title">../..</p>
                                        <p class="seft-text">Là một ngôn ngữ đánh dấu siêu văn bản nên HTML sẽ có vai
                                            trò xây dựng cấu trúc siêu văn bản trên một website, hoặc khai báo các tập
                                            tin kỹ thuật số như hình ảnh, video, nhạc. Học lập trình web với HTML sẽ
                                            định hướng
                                            cho mình muốn theo đuổi lập trình web. CSS tạo phong cách và định kiểu cho
                                            các yếu tố được viết dưới dạng ngôn ngữ đánh dấu HTML. Nó giúp người dùng
                                            tiết kiệm thời gian và công sức viết web nhờ khả năng điều
                                            khiển định dạng của nhiều trang web cùng lúc.</p>
                                    </div>
                                    <div class="seft">
                                        <i class="seft-icon fas fa-dot-circle"></i>
                                        <h4 class="seft-heading">Học và rèn luyện Javascript</h4>
                                        <p class="seft-title">../...</p>
                                        <p class="seft-text">JavaScript là ngôn ngữ lập trình phổ biến nhất, Javascript
                                            có lương viện đảm bảo và có cơ hội việc làm nhiều hơn nên mình chọn
                                            Javascript để học .</p>
                                    </div>
                                </div>
                                <div class="pane-section_wrap">
                                    <h2 class="pane-section">
                                        <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js">
                                        </script>
                                        <lord-icon src="https://cdn.lordicon.com/kbtmbyzy.json" trigger="loop"
                                            colors="primary:#121331,secondary:#08a88a" style="width:32px;height:32px">
                                        </lord-icon>
                                        Khi ổn định kiến thức
                                    </h2>
                                    <div class="seft">
                                        <i class="seft-icon fas fa-dot-circle"></i>
                                        <h4 class="seft-heading">Xin đi thực tập</h4>
                                        <p class="seft-title">../..</p>
                                        <p class="seft-text">Thực tập là một cơ hội để mình học hỏi, áp dụng những lý
                                            thuyết được học vào thực tế và làm quen với môi trường làm việc quy củ và có
                                            được thành công cao hơn khi đi làm thực sự.</p>
                                    </div>
                                    <div class="seft">
                                        <i class="seft-icon fas fa-dot-circle"></i>
                                        <h4 class="seft-heading">Thực tập xong</h4>
                                        <p class="seft-title">../..</p>
                                        <p class="seft-text">Tập trung bổ sung các vấn đề còn thiếu sót mình nhận ra
                                            được sau khi thực tập, nếu ổn định sẽ xin ở lại thử việc.</p>
                                    </div>
                                </div>
                            </li>
                            <li class="pane-item">Ngân Dút</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    const $ = document.querySelector.bind(document);
    const $$ = document.querySelectorAll.bind(document);

    const tabs = $$(".option-item");
    const panes = $$(".pane-item");
    const tabActive = $(".option-item.active");


    tabs.forEach((tab, index) => {
        const pane = panes[index];
        tab.onclick = function() {
            $(".option-item.active").classList.remove("active");
            $(".pane-item.active").classList.remove("active");
            this.classList.add("active");
            pane.classList.add("active");
        };
    });
    </script>

</div>
<!--features_items-->



@endsection