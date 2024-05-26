@extends('layout-app.web') <!-- Extend the main template -->

@section('content')
    <div class="content_desc">
        <div class="content_title">
            <div class="sub_title">
                <p>NOTICE</p>
            </div>
            <div class="sub_navi">
                <p><img src="{{asset('images/navi_home.png')}}">> NOTICE </p>
            </div>
        </div>
        <div class="tbl_head01 tbl_wrap">
            <table>
                <caption>공지사항-영문 목록</caption>
                <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Writer</th>
                    <th scope="col"><a href="#">Date</a></th>
                    <th scope="col"><a href="#">Hits </a></th>
                </tr>
                </thead>
                <tbody>
                <tr class="bo_notice">
                    <td class="td_num">
                        <strong>Notice</strong></td>
                    <td class="td_subject">

                        <a href="#">
                            Membership Program </a>

                        <img src="http://www.theodbo.co.kr/en/skin/board/basic/img/icon_hot.gif" alt="인기글"></td>
                    <td class="td_name sv_use"><span class="sv_member">최고관리자</span></td>
                    <td class="td_date">05-28</td>
                    <td class="td_num">3397</td>
                </tr>
                <tr class="">
                    <td class="td_num">
                        3
                    </td>
                    <td class="td_subject">

                        <a href="#">
                            Membership Terms &amp; Conditions </a>

                        <img src="http://www.theodbo.co.kr/en/skin/board/basic/img/icon_hot.gif" alt="인기글"></td>
                    <td class="td_name sv_use"><span class="sv_member">최고관리자</span></td>
                    <td class="td_date">03-26</td>
                    <td class="td_num">1455</td>
                </tr>
                <tr class="">
                    <td class="td_num">
                        2
                    </td>
                    <td class="td_subject">

                        <a href="#">
                            Privacy Policy </a>

                        <img src="http://www.theodbo.co.kr/en/skin/board/basic/img/icon_hot.gif" alt="인기글"></td>
                    <td class="td_name sv_use"><span class="sv_member">최고관리자</span></td>
                    <td class="td_date">03-25</td>
                    <td class="td_num">1927</td>
                </tr>
                <tr class="">
                    <td class="td_num">
                        1
                    </td>
                    <td class="td_subject">

                        <a href="#">
                            Terms and Conditions </a>

                        <img src="http://www.theodbo.co.kr/en/skin/board/basic/img/icon_hot.gif" alt="인기글"></td>
                    <td class="td_name sv_use"><span class="sv_member">최고관리자</span></td>
                    <td class="td_date">03-25</td>
                    <td class="td_num">1686</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
