@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; About Us</title>
<meta  name="description" content="About Us">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - About Us"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
<style>
    .platform-computer {
        margin: 40px auto auto;
        position: relative;
        max-width: 600px;
    }
    .platform-computer img {
        max-width: 100%;
    }
    .platform-computer .platform-feature {
        padding-bottom: 20px;

    }
    .platform-computer .platform-feature:hover .platform-icon {
        transform: scale(1.2) translateY(-10px);
        box-shadow: 0 10px 6px rgba(0, 0, 0, 0.1);
        transition: 0.3s;
    }
    .platform-computer .platform-icon {
        position: relative;
        padding: 30px;
        background: #fff;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.12);
        border: 1px solid #f1f1f1;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: inline-block;
        margin-bottom: 30px;
        top: 20px;
        transition: 0.3s;
    }
    .platform-computer .platform-icon img {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 30px;
        transform: translate(-50%, -50%);
    }
    @media (min-width: 768px) {
        .platform-block {
            padding: 50px 50px 120px;
        }
        .platform-computer {
            margin: 40px auto auto;
            position: relative;
            max-width: 300px;
        }
        .platform-computer .platform-feature {
            position: absolute;
            width: 250px;

        }
        .platform-computer .platform-feature .platform-icon {
            position: absolute;
        }
        .platform-computer .platform-feature.fast-payments {
            top: 0;
            left: -170px;
            padding-right: 80px;
            text-align: right;
        }
        .platform-computer .platform-feature.fast-payments .platform-icon {
            right: 0;
            top: 0;
        }
        .platform-computer .platform-feature.layered-security {
            top: 0;
            right: -170px;
            padding-left: 80px;
            text-align: left;
        }
        .platform-computer .platform-feature.layered-security .platform-icon {
            left: 0;
            top: 0;
        }
        .platform-computer .platform-feature.proprietary-tech {
            bottom: -120px;
            left: -170px;
            padding-right: 80px;
            text-align: right;
        }
        .platform-computer .platform-feature.proprietary-tech .platform-icon {
            right: 0;
            top: 0;
        }
        .platform-computer .platform-feature.transparent-reporting {
            bottom: -120px;
            right: -170px;
            padding-left: 80px;
            text-align: left;
        }
        .platform-computer .platform-feature.transparent-reporting .platform-icon {
            left: 0;
            top: 0;
        }
    }
    @media (min-width: 992px) {
        .platform-computer {
            max-width: 500px;
        }
        .platform-computer .platform-feature {
            width: 360px;
        }
        .platform-computer .platform-feature .platform-icon {
            position: absolute;
        }
        .platform-computer .platform-feature .platform-icon img {
            width: 50%;
            margin: auto;
        }
        .platform-computer .platform-feature.fast-payments {
            left: -250px;
            top: 30px;
        }
        .platform-computer .platform-feature.layered-security {
            right: -250px;
            top: 30px;
        }
        .platform-computer .platform-feature.proprietary-tech {
            bottom: -40px;
            left: -250px;
        }
        .platform-computer .platform-feature.transparent-reporting {
            bottom: -40px;
            right: -250px;
        }
    }
    @media (min-width: 1800px) {
        .platform-block {
            padding: 130px 50px;
        }
        .platform-block h1 {
            margin-bottom: 60px;
        }
        .platform-block .lead {

        }
        .platform-computer {
            margin: 146px auto auto;
            position: relative;
            max-width: 751px;
        }
        .platform-computer img {
            max-width: 100%;
        }
        .platform-computer .platform-feature {
            width: 429px;

            line-height: 23px;
        }
        .platform-computer .platform-feature .platform-icon {
            width: 125px;
            height: 125px;
        }
        .platform-computer .platform-feature.fast-payments {
            left: -399px;
            top: 30px;
        }
        .platform-computer .platform-feature.fast-payments .platform-icon {
            right: -90px;
            top: 30px;
        }
        .platform-computer .platform-feature.layered-security {
            right: -399px;
            top: 30px;
        }
        .platform-computer .platform-feature.layered-security .platform-icon {
            left: -90px;
            top: 30px;
        }
        .platform-computer .platform-feature.proprietary-tech {
            top: 70%;
            left: -399px;
        }
        .platform-computer .platform-feature.proprietary-tech .platform-icon {
            right: -90px;
            top: 30px;
        }
        .platform-computer .platform-feature.transparent-reporting {
            top: 70%;
            right: -399px;
        }
        .platform-computer .platform-feature.transparent-reporting .platform-icon {
            left: -90px;
            top: 30px;
        }
        .platform-computer .platform-feature:hover .platform-icon {
            transform: scale(1.2) translateY(-10px);
            box-shadow: 0 10px 6px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }
        .platform-computer .platform-icon {
            position: relative;
            padding: 30px;
            background: #fff;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.12);
            border: 1px solid #f1f1f1;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: inline-block;
            margin-bottom: 30px;
            top: 20px;
            transition: 0.3s;
        }
        .platform-computer .platform-icon img {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 30px;
            transform: translate(-50%, -50%);
        }
    }
    .ace-trader-block {
        padding: 40px 35px;
        text-align: center;
        background: linear-gradient(180deg, hsla(0, 0%, 100%, 0), #8abc57);
        line-height: 12px;
        border-bottom: 1px solid #82b84c;
    }
    .ace-trader-block h1 {
        font-weight: 900;
        color: #8abc57;
        text-transform: uppercase;
    }
    .ace-trader-block .ace-trader-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        text-align: center;
        grid-gap: 30px;
        margin: 30px auto;
    }
    .ace-trader-block .ace-trader-grid .ace-grid-item {
        padding: 10px;
        position: relative;
        text-align: left;
        color: #fff;
    }
    .ace-trader-block .ace-trader-grid .ace-grid-item .step-content {
        padding-left: 20px;
        position: relative;
        z-index: 999;
    }
    .ace-trader-block .ace-trader-grid .ace-grid-item .step-number {
        position: absolute;
        top: 0;
        left: 0;
        color: #a3cb7b;
        font-weight: 700;
        line-height: 80px;
        text-shadow: 0 0 12px hsla(0, 0%, 100%, 0.2);
        opacity: 0.4;
    }
    .ace-trader-block .ace-trader-grid .ace-grid-item:last-child .step-content h3 {
        margin-top: 10px;
        font-size: 200%;
    }
    @media (min-width: 768px) {
        .ace-trader-block {
            padding: 40px;
        }
        .ace-trader-block .ace-container {
            max-width: 900px;
            margin: auto;
        }
        .ace-trader-block .step-content {
            padding-left: 30px;
        }
        .ace-trader-block .ace-trader-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            text-align: center;
            grid-gap: 30px;
            margin: 30px auto;
        }
    }
    @media (min-width: 1220px) {
        .ace-trader-block {
            padding: 60px;
        }
        .ace-trader-block .ace-container {
            max-width: 1000px;
            margin: auto;
        }
        .ace-trader-block .step-content {
            padding-left: 30px;
            padding-right: 30px;
        }
        .ace-trader-block .ace-trader-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            text-align: center;
            grid-gap: 30px;
            margin: 50px auto;
        }
        .ace-trader-block .ace-trader-grid .ace-grid-item {
            font-size: 14px;
            line-height: 20px;
        }
        .ace-trader-block .ace-trader-grid .ace-grid-item .step-number {
            font-size: 150px;
        }
    }
    @media (min-width: 1800px) {
        .ace-trader-block {
            padding: 118px;
        }
        .ace-trader-block h1 {
            font-size: 3rem;
            letter-spacing: 2px;
        }
        .ace-trader-block .ace-container {
            max-width: 1350px;
            margin: auto;
        }
        .ace-trader-block .step-content {
            padding: 40px 60px;
        }
        .ace-trader-block .step-content h3 {
            font-size: 35px;
        }
        .ace-trader-block .ace-trader-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto;
            text-align: center;
            grid-gap: 30px;
            margin: 130px auto;
        }
        .ace-trader-block .ace-trader-grid .ace-grid-item {
            font-size: 20px;
            line-height: 20px;
        }
        .ace-trader-block .ace-trader-grid .ace-grid-item .step-number {
            font-size: 270px;
            top: 50%;
            transform: translateY(-50%);
        }
    }
    .testimonial-block {
        padding: 50px 0;
        text-align: center;
        background-image: url(../img/testimonials-bg.jpg);
        background-size: cover;
        background-position: 50%;
        background-attachment: fixed;
        font-weight: 400;
        font-size: 13px;
        min-height: 400px;
    }
    .testimonial-block strong {
        font-size: 110%;
    }
    .testimonial-block h1 {
        font-weight: 500;
    }
    .testimonial-block .carousel-caption {
        color: #000;
        position: static;
        width: 60%;
        margin: auto;
    }
    .testimonial-block .carousel-control-next-icon:after {
        font-family: FontAwesome;
        font-weight: 900;
        content: "\F054";
        color: #000;
    }
    .testimonial-block .carousel-control-prev-icon:after {
        font-family: FontAwesome;
        font-weight: 900;
        content: "\F053";
        color: #000;
    }
    @media (min-width: 1800px) {
        .testimonial-block {
            padding: 104px 0;
        }
        .testimonial-block strong {
            font-size: 110%;
        }
        .testimonial-block h1 {
            font-weight: 700;
            font-size: 57px;
            margin-bottom: 40px;
        }
        .testimonial-block .carousel-inner {
            margin: auto;
            min-height: 415px;
        }
        .testimonial-block .carousel-item {
            padding-left: 10%;
            padding-right: 10%;
        }
        .testimonial-block .carousel-caption {
            width: 80%;
            font-size: 24px;
        }
    }
    .login {
        background-image: url(../img/login-bg.jpg);
        background-size: cover;
        background-attachment: fixed;
        color: #fff;
    }
    .login .login-form {
        position: absolute;
        width: 486px;
        max-width: 90%;
        top: 50%;
        left: 50%;
        background: #8abc57;
        border-radius: 33px;
        padding: 40px;
        transform: translate(-50%, -50%);
        box-shadow: 0 10px 12px hsla(0, 0%, 100%, 0.2);
    }
    .login .login-form .hidden {
        display: none;
    }
    .login .login-form h3 {
        font-size: 36px;
    }
    .login .login-form p {
        margin-bottom: 30px;
    }
    .login .login-form a {
        color: #fff;
    }
    .login .login-form .logo {
        padding: 20px;
        width: 75%;
        max-width: 290px;
        margin: auto;
        margin-bottom: 15px;
    }
    .login .login-form .logo img {
        max-width: 100%;
    }
    .login .login-form .btn {
        font-weight: 700;
        padding: 10px 30px;
        margin-bottom: 20px;
    }
    .login .login-form input[type="password"],
    .login .login-form input[type="text"] {
        border: 1.5px solid #fff;
        background-color: transparent;
        border-radius: 33px;
        padding: 12px 30px;
        color: #fff;
        width: 90%;
        display: block;
        margin: auto auto 20px;
    }
    @media (min-width: 768px) {
        .login {
            background-image: url(../img/login-bg.jpg);
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
        }
        .login .login-form h3 {
            font-size: 39pt;
        }
        .login p {
            margin-bottom: 30px;
            font-size: 20px;
        }
    }
    .coming-soon-splash {
        position: absolute;
        text-align: center;
        top: 67px;
        left: 0;
        bottom: 0;
        width: 100%;
        background-image: url(../img/coming-soon-event-bg-mobile.jpg);
        background-size: cover;
        background-position: 50%;
    }
    .coming-soon-bg {
        z-index: -1;
    }
    .coming-soon-bg.desktop {
        display: none;
    }
    .coming-soon-bg img {
        width: 100%;
        max-width: 100%;
    }
    .coming-soon-block {
        position: absolute;
        top: 50%;
        left: 50%;
        color: #fff;
        transform: translate(-50%, -50%);
        width: 90%;
        margin: auto;
    }
    .coming-soon-block h1 {
        margin: 50px auto 30px;
        font-weight: 900;
        font-size: 40px;
    }
    .coming-soon-social {
        margin-top: 50px;
    }
    .coming-soon-social a {
        font-size: 30px;
        margin-right: 20px;
        color: #fff;
    }
    @media (min-width: 992px) {
        .coming-soon-splash {
            top: 86px;
            background-image: url(../img/coming-soon-event-bg.jpg);
            background-size: cover;
            background-position: 50%;
        }
        .coming-soon-bg.desktop {
            display: block;
        }
        .coming-soon-bg.mobile {
            display: none;
        }
    }
    .plans-list {
        background-image: url(../img/plan-dotted-bg-1.png);
        background-size: 150px;
        background-repeat: no-repeat;
    }
    .plan-block {
        text-align: center;
        margin-bottom: 50px;
    }
    .plan-block:nth-child(2) {
        background-position: 100%;
    }
    .plan-block:nth-child(2),
    .plan-block:nth-child(3) {
        background-image: url(../img/plan-dotted-bg-2.png);
        background-size: 120px;
        background-repeat: no-repeat;
    }
    .plan-block:nth-child(3) {
        background-position: 0;
    }
    .plan-title {
        padding: 40px 0;
        position: relative;
    }
    .plan-title h1 {
        font-weight: 700;
        font-size: 30px;
    }
    .plan-title .plan-title-underlay {
        position: absolute;
        font-size: 60px;
        top: 50%;
        transform: translateY(-50%);
        width: 100%;
        font-weight: 900;
        color: rgba(0, 0, 0, 0.05);
    }
    .package-card {
        padding: 40px 20px;
        border-radius: 22px;
        border: 5px solid #ccc;
        text-align: center;
        position: relative;
        margin-top: 100px;
    }
    .package-card p.package-feature-list {
        line-height: 190%;
    }
    .package-icon {
        max-width: 80%;
        margin: auto;
        margin-top: -120px;
        margin-bottom: 30px;
        visibility: hidden;
    }
    .package-icon img {
        max-width: 100%;
    }
    .academy-240 {
        border-color: #1a51ce;
        background-color: #f4f7ff;
        color: #1a51ce;
    }
    .academy-240 .btn-default {
        background-color: #1a51ce;
        border-color: #1a51ce;
    }
    .academy-240 .btn-default:hover {
        background-color: #638ceb;
        border-color: #1a51ce;
    }
    .academy-900 {
        border-color: #23d281;
        background-color: #ebfdf5;
        color: #23d281;
    }
    .academy-900 .btn-default {
        background-color: #23d281;
        border-color: #23d281;
    }
    .academy-900 .btn-default:hover {
        background-color: #73e8b2;
        border-color: #23d281;
    }
    .elemental-300 {
        border-color: #858287;
        background-color: #efeeee;
        color: #858287;
    }
    .elemental-300 .btn-default {
        background-color: #858287;
        border-color: #858287;
    }
    .elemental-300 .btn-default:hover {
        background-color: #b8b6b9;
        border-color: #858287;
    }
    .elemental-500 {
        border-color: #2a8dc5;
        background-color: #e3f5ff;
        color: #2a8dc5;
    }
    .elemental-500 .btn-default {
        background-color: #2a8dc5;
        border-color: #2a8dc5;
    }
    .elemental-500 .btn-default:hover {
        background-color: #74bae1;
        border-color: #2a8dc5;
    }
    .elemental-1k {
        border-color: #b60c28;
        background-color: #ffedf0;
        color: #b60c28;
    }
    .elemental-1k .btn-default {
        background-color: #b60c28;
        border-color: #b60c28;
    }
    .elemental-1k .btn-default:hover {
        background-color: #f23655;
        border-color: #b60c28;
    }
    .elemental-2k {
        border-color: #99118f;
        background-color: #ffeafe;
        color: #99118f;
    }
    .elemental-2k .btn-default {
        background-color: #99118f;
        border-color: #99118f;
    }
    .elemental-2k .btn-default:hover {
        background-color: #e729d9;
        border-color: #99118f;
    }
    .advanced-5k {
        border-color: #ff7f00;
        background-color: #ffecd9;
        color: #ff7f00;
    }
    .advanced-5k .btn-default {
        background-color: #ff7f00;
        border-color: #ff7f00;
    }
    .advanced-5k .btn-default:hover {
        background-color: #ffb266;
        border-color: #ff7f00;
    }
    .advanced-10k {
        border-color: #494e92;
        background-color: #eeefff;
        color: #494e92;
    }
    .advanced-10k .btn-default {
        background-color: #494e92;
        border-color: #494e92;
    }
    .advanced-10k .btn-default:hover {
        background-color: #8185c0;
        border-color: #494e92;
    }
    .advanced-20k {
        border-color: #709d48;
        background-color: #f6ffee;
        color: #709d48;
    }
    .advanced-20k .btn-default {
        background-color: #709d48;
        border-color: #709d48;
    }
    .advanced-20k .btn-default:hover {
        background-color: #a4c784;
        border-color: #709d48;
    }
    .supreme-30k {
        border-color: #249f92;
        background-color: #e9fffd;
        color: #249f92;
    }
    .supreme-30k .btn-default {
        background-color: #249f92;
        border-color: #249f92;
    }
    .supreme-30k .btn-default:hover {
        background-color: #51d8c9;
        border-color: #249f92;
    }
    .supreme-50k {
        border-color: #c71c88;
        background-color: #ffe8f7;
        color: #c71c88;
    }
    .supreme-50k .btn-default {
        background-color: #c71c88;
        border-color: #c71c88;
    }
    .supreme-50k .btn-default:hover {
        background-color: #e960b6;
        border-color: #c71c88;
    }
    .supreme-100k {
        border-color: #ebac00;
        background-color: #fffaeb;
        color: #ebac00;
    }
    .supreme-100k .btn-default {
        background-color: #ebac00;
        border-color: #ebac00;
    }
    .supreme-100k .btn-default:hover {
        background-color: #ffd152;
        border-color: #ebac00;
    }
    @media (min-width: 768px) {
        .plans-splash-text h1 {
            font-size: 50px;
        }
        .plans-splash-text h3 {
            font-size: 26px;
        }
        .plans-list {
            padding: 50px 0;
        }
        .plan-title h1 {
            font-size: 40px;
        }
        .plan-title .plan-title-underlay {
            font-size: 90px;
        }
    }
    @media (min-width: 992px) {
        .plans-splash-text h1 {
            font-size: 50px;
        }
        .plans-splash-text h3 {
            font-size: 26px;
        }
        .plan-title h1 {
            font-size: 50px;
        }
        .plan-title .plan-title-underlay {
            font-size: 120px;
        }
        .plans-bg.desktop {
            display: block;
        }
        .plans-bg.mobile {
            display: none;
        }
        .package-card {
            min-height: 414px;
        }
    }
    .experience-block {
        background: url(../img/event-bg.jpg);
        background-size: cover;
        padding: 80px;
        text-align: center;
        color: #fff;
    }
    .experience-block h1 {
        margin-bottom: 30px;
    }
    .experience-block .btn-default:hover {
        background: #fff;
        border-color: #fff;
        color: #000 !important;
    }
    @media (min-width: 1800px) {
        .experience-block {
            background: url(../img/event-bg.jpg);
            background-size: cover;
            padding: 160px 80px 183px;
        }
        .experience-block h1 {
            margin-bottom: 65px;
            font-size: 53px;
        }
        .experience-block .btn-default {
            padding: 26px 99px;
            font-size: 119%;
            border-radius: 56px;
        }
    }
    .about {
        background: url(../img/about-us-bg.jpg);
        background-size: contain;
        background-repeat: no-repeat;
        background-position: top;
        background-color: #f5f5f5;
    }
    .about-us-top-block {
        padding: 60px 20px;
    }
    .about-us-top-block h3 {
        color: #8abc57;
        margin-bottom: 30px;
    }
    .about-us-top-block .highlight {
        color: #8abc57;
    }
    .founders-block {
        background-image: url(../img/founders-bg.png);
        background-repeat: no-repeat;
        background-size: 200px;
        padding: 60px 20px;
        padding-bottom: 100px;
        font-size: 130%;
        max-width: 85%;
        margin: auto;
    }
    .founders-block .lead,
    .founders-block h3 {
        text-align: right;
        color: #8abc57;
    }
    .founder-pic-container {
        position: relative;
    }
    .founder-pic {
        height: 250px;
        width: 250px;
        margin: auto;
        margin-block: 30px;
        border-radius: 50%;
        border: 10px solid #8abc57;
        overflow: hidden;
    }
    .founder-pic img {
        width: 100%;
    }
    .mission-block {
        background-image: url(../img/mission-vision-bg.jpg);
        background-size: cover;
        padding-bottom: 30px;
    }
    .mission-block .mission-block-content {
        color: #fff;
        padding-top: 30px;
    }
    .mission-block .mission-block-content .col-sm-4 {
        margin-bottom: 30px;
    }
    .mission-block .mission-block-content .misson-block-icon {
        width: 60px;
        margin-bottom: 30px;
    }
    .mission-block .mission-block-content .misson-block-icon img {
        max-width: 100%;
    }
    .mission-block .about-us-stat-bar {
        background: #fff;
        padding: 30px;
        text-align: center;
        position: relative;
    }
    .mission-block .about-us-stat-bar strong {
        margin-bottom: 30px;
        display: block;
    }
    .mission-block .about-us-stat-bar h3 {
        color: #8abc57;
        font-weight: 700;
    }
    .work-goals-block {
        background: #8abc57;
    }
    .work-goals-block .work-goals-grid {
        display: grid;
        grid-template-columns: 1fr;
    }
    .work-goals-block .our-work {
        padding: 3rem;
        padding-left: 5rem;
        position: relative;
        background: #fff;
        color: #8abc57;
    }
    .work-goals-block .our-work:after {
        position: absolute;
        content: "";
        left: 0;
        bottom: 0;
        width: 8%;
        height: 16%;
        background: #8abc57;
    }
    .work-goals-block .our-goals {
        padding: 3rem;
        padding-left: 5rem;
        position: relative;
        color: #fff;
    }
    .work-goals-block .our-goals:after {
        position: absolute;
        content: "";
        left: 0;
        top: 0;
        width: 8%;
        height: 16%;
        background: #fff;
    }
    .work-goals-block img {
        max-width: 100%;
    }
    .h1-container {
        position: relative;
    }
    .h1-container svg {
        position: absolute;
        width: 100%;
        top: 0;
        left: 0;
        display: none;
    }
    .h1-container h1 {
        padding-left: 0;
    }
    .team-block {
        padding: 50px 20px;
        background-image: url(../img/dotted-bg-about-us.png);
        background-repeat: no-repeat;
        background-size: contain;
    }
    .team-block .container-fluid,
    .team-block img {
        max-width: 100%;
    }
    .team-block img.rounded-circle {
        max-width: 80%;
        margin-bottom: 10px;
    }
    .team-block .col-sm-3.col-lg-2 {
        margin-bottom: 30px;
    }
    .team-block h3,
    .team-block p {
        color: #8abc57;
        margin-bottom: 6px;
    }
    .team-block .staff-block {
        margin-bottom: 50px;
    }
    .team-block .staff-block h3 {
        margin-bottom: 10px;
        font-size: 26px;
        font-weight: 700;
    }
    .team-block .staff-block p {
        font-size: 80%;
    }
    @media (min-width: 768px) {
        .about-us-top-block {
            padding: 50px;
        }
        .about-us-top-block h2 {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80%;
            transform: translate(-50%, -50%);
        }
        .mission-block {
            padding-top: 120px;
            position: relative;
        }
        .mission-block .mission-block-content {
            color: #fff;
            max-width: 80%;
            margin: auto;
        }
        .mission-block .col-sm-4 {
            margin-bottom: 0;
        }
        .mission-block .about-us-stat-bar {
            width: 85%;
            position: absolute;
            left: 50%;
            box-shadow: 0 10px 12px rgba(0, 0, 0, 0.3);
            transform: translateX(-50%);
            top: -50px;
        }
        .mission-block .about-us-stat-bar h3 {
            color: #8abc57;
            font-weight: 700;
        }
        .mission-block .about-us-stat-bar strong {
            margin-bottom: 0;
        }
        .about-us-stat-bar {
            max-width: 90%;
        }
    }
    @media (min-width: 992px) {
        .about-us-top-block {
            padding: 50px;
        }
        .about-us-top-block h2 {
            font-size: 45px;
        }
        .founder-pic {
            height: 360px;
            width: 360px;
            border-radius: 50%;
            border: 10px solid #8abc57;
            overflow: hidden;
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .founder-bio {
            position: relative;
        }
        .founders-block {
            background-size: 400px;
        }
        .work-goals-block .our-goals,
        .work-goals-block .our-work {
            padding: 3rem;
            padding-left: 8rem;
        }
        .work-goals-block .work-goals-grid {
            display: grid;
            grid-template-columns: 55% 45%;
        }
        .about,
        .team-block {
            background-size: cover;
        }
        .team-block {
            background-position: center 140px;
        }
        .h1-container svg {
            display: block;
        }
    }
    @media (min-width: 1200px) {
        .founders-block {
            background-size: 500px;
        }
        .team-block .staff-block {
            margin-bottom: 50px;
        }
        .team-block .staff-block h3 {
            font-size: 23px;
            margin-bottom: 10px;
        }
        .team-block .staff-block p {
            font-size: 96%;
        }
    }
    .headquarters-block {
        background-image: url(../img/headquarters-bg.jpg);
        padding-bottom: 50px;
        border-bottom: 10px solid #8abc57;
    }
    .headquarters-container {
        padding: 60px 0;
    }
    .headquarters-container h1 {
        padding: 40px 0;
    }
    .headquarters-grid {
        padding: 10px 0;
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 10px;
        background: hsla(0, 0%, 100%, 0.5);
    }
    .headquarters-grid img {
        max-width: 100%;
        min-height: 100%;
    }
    p.team-info {
        font-size: 18px !important;
        text-align: left;
    }
    @media (min-width: 768px) {
        .headquarters-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-gap: 10px;
        }
        p.team-info {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 100%;
            transform: translate(-50%, -50%);
        }
    }
    @media (min-width: 1800px) {
        .about-us-top-block {
            padding: 107px 50px 104px;
            font-size: 24px;
        }
        .about-us-top-block h2 {
            position: absolute;
            top: 33%;
            left: 46%;
            width: 80%;
            transform: translate(-50%, -50%);
        }
        .about-us-top-block h3 {
            font-size: 36px;
        }
        p.team-info {
            font-size: 24px !important;
        }
        .founders-block {
            padding-bottom: 250px;
        }
        .founders-block p {
            line-height: 36px;
            font-size: 27px;
        }
        .founders-block h3 {
            font-size: 47px;
        }
        .founders-block .lead {
            font-size: 34px;
        }
        .founder-pic {
            height: 450px;
            width: 450px;
            top: 52%;
            left: 56%;
        }
        .mission-block {
            padding-top: 180px;
        }
        .mission-block h3 {
            font-size: 44px;
            margin-bottom: 20px;
        }
        .mission-block .mission-block-content .misson-block-icon {
            width: 100px;
            margin-bottom: 30px;
        }
        .mission-block .about-us-stat-bar {
            width: 85%;
            position: absolute;
            left: 50%;
            box-shadow: 0 10px 12px rgba(0, 0, 0, 0.3);
            transform: translateX(-50%);
            top: -50px;
        }
        .mission-block .about-us-stat-bar h3 {
            color: #8abc57;
            font-weight: 700;
            font-size: 50px;
        }
        .mission-block .about-us-stat-bar strong {
            line-height: 23px;
            font-weight: 700;
            font-size: 23px;
        }
        .work-goals-block .our-goals,
        .work-goals-block .our-work {
            padding: 4.5rem;
            padding-left: 8rem;
            font-size: 21px;
        }
        .work-goals-block h1 {
            font-size: 48px;
            font-weight: 700;
            margin-bottom: 21px;
        }
        .team-block {
            padding: 140px 20px;
        }
        .team-block img.rounded-circle {
            max-width: 85%;
            margin-bottom: 10px;
        }
        .team-block .plan-title {
            margin-bottom: 108px;
        }
        .team-block .staff-block {
            margin-bottom: 145px;
        }
        .team-block .staff-block:last-child {
            margin-bottom: 0;
        }
        .tcp-info {
            font-size: 23px;
            margin: auto;
            max-width: 53%;
        }
        .headquarters-container h1 {
            padding: 40px 0;
            font-size: 70px;
        }
        .headquarters-container p {
            font-size: 18px;
        }
        .h1-container {
            position: relative;
        }
        .h1-container svg {
            position: absolute;
            width: 100%;
            top: 0;
            left: -50px;
        }
        .h1-container h1 {
            padding-left: 30px;
        }
    }
    .forex h1 {
        font-weight: 900;
    }
    .forex-ticker {
        padding: 10px;
        background: #172546;
    }
    .forex-top-block {
        background-image: url(../img/forex-guy.png);
        background-size: 80%;
        background-repeat: no-repeat;
        background-position: bottom;
        padding: 60px 20px;
        padding-bottom: 300px;
    }
    .forex-top-block h1 {
        font-weight: 900;
        margin-bottom: 30px;
        color: #8abc57;
    }
    .forex-item-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-gap: 15px;
    }
    .forex-card {
        padding: 20px 30px;
        border-radius: 20px;
        box-shadow: 0 -6px 12px rgba(0, 0, 0, 0.2);
        text-align: center;
    }
    .forex-icon {
        max-width: 60px;
        margin: 20px auto;
    }
    .forex-icon img {
        max-width: 100%;
    }
    .forex-info {
        padding: 50px;
        text-align: center;
        color: #fff;
        background: url(../img/forex-info-bg.png);
        background-size: cover;
    }
    .forex-info a,
    .forex-info h1 {
        color: #8abc57;
    }
    .forex-info .forex-info-container {
        max-width: 1170px;
        margin: auto;
    }
    @media (min-width: 768px) {
        .forex-top-block {
            background-image: url(../img/forex-guy.png);
            background-size: 65%;
            background-repeat: no-repeat;
            background-position: bottom;
            padding: 60px 20px;
            padding-bottom: 500px;
        }
        .forex-item-grid {
            grid-gap: 30px;
        }
    }
    @media (min-width: 992px) {
        .forex-top-block {
            background-image: url(../img/forex-guy.png);
            background-size: 40%;
            background-repeat: no-repeat;
            background-position: 10% bottom;
            padding: 60px;
        }
        .forex-top-block h1 {
            font-size: 100px;
        }
        .forex-info {
            padding: 70px;
        }
    }
    .partner-broker {
        padding: 60px 0;
        color: #fff;
        background-image: url(../img/partner-broker-bg.jpg);
        background-size: cover;
        position: relative;
        padding-bottom: 140px;
    }
    .partner-broker-container {
        margin: auto;
    }
    .icons {
        max-width: 80%;
        font-size: 80%;
    }
    .icons,
    .icons .col-3 {
        text-align: center;
    }
    .icons img {
        max-width: 100%;
        margin-bottom: 10px;
    }
    .sevilla {
        padding: 30px 0;
    }
    .partner-broker-gradient {
        position: absolute;
        width: 100%;
        bottom: 0;
        left: 0;
        height: 240px;
        background: linear-gradient(0deg, #fff 10%, hsla(0, 0%, 100%, 0));
    }
    .everfx-logo {
        padding: 20px 0;
    }
    .award-icon img {
        max-width: 100%;
    }
    .partner-broker-container {
        width: 90%;
    }
    @media (min-width: 768px) {
        .partner-broker-container {
            width: 75%;
        }
    }
    .forex-everyone {
        padding: 40px 0;
        background-size: cover;
    }
    .forex-everyone h1 {
        font-weight: 700;
    }
    .forex-everyone-container {
        width: 75%;
        margin: auto;
    }
    @media (min-width: 768px) {
        .forex-everyone {
            padding: 0;
            padding-bottom: 80px;
            background-image: url(../img/forex-last-bg-mobile.jpg);
            background-size: cover;
            background-position: top;
        }
    }
    @media (min-width: 992px) {
        .partner-broker-container {
            width: 75%;
        }
        .forex-everyone {
            padding: 120px 0;
            background-image: url(../img/forex-last-bg.jpg);
            background-size: cover;
            background-position: top;
        }
    }
    @media (min-width: 1800px) {
        .forex-top-block {
            background-position: 178px bottom;
            background-size: 42.2%;
            padding: 135px 20px;
        }
        .forex-top-block h1 {
            font-size: 133px;
        }
        .forex-card {
            padding: 30px;
        }
        .forex-item-grid {
            padding-left: 100px;
            padding-right: 100px;
        }
        .forex-icon {
            max-width: 120px;
            margin: 40px auto;
        }
        .forex-info {
            padding: 91px;
            font-size: 25.5px;
        }
        .forex-info h1 {
            font-size: 2.7rem;
            font-weight: 700;
            margin-bottom: 38px;
        }
        .partner-broker {
            padding: 125px 0;
            padding-bottom: 140px;
        }
        .partner-broker-container {
            width: 1375px;
            font-size: 24px;
        }
        .partner-broker-container .btn {
            font-size: 26px;
            padding: 16px 39px;
        }
        .partner-broker-container h3 {
            letter-spacing: 5px;
            margin-bottom: 42px;
        }
        .partner-broker-container .award-icon {
            font-size: 15px;
            line-height: 17px;
            margin-bottom: 25px;
        }
        .partner-broker-container .award-icon img {
            margin-bottom: 30px;
        }
        .partner-broker-container .award-icon strong {
            display: block;
            margin-top: 20px;
            font-size: 14px;
            font-weight: 700;
        }
        .everfx-logo {
            padding: 25px 0 50px;
        }
        .icons {
            width: 88%;
            max-width: 88%;
            margin-bottom: 49px;
        }
        .forex-everyone {
            padding: 87px 0 200px;
            font-size: 22px;
        }
        .forex-everyone h1 {
            font-weight: 700;
            font-size: 2.7rem;
            margin-bottom: 70px;
        }
        .forex-everyone .forex-everyone-container {
            width: 90%;
            margin: auto;
        }
        .forex-everyone .container-fluid {
            max-width: 1800px;
        }
        .forex-everyone .btn {
            font-weight: 700;
            padding: 27px 71px;
            font-size: 22px;
            margin-top: 60px;
            border-radius: 69px;
        }
        .forex-everyone .pl-lg-5 {
            padding-left: 67px !important;
        }
    }
    .cfx-trading-program {
        background-image: url(../img/cfx-trader-bg.jpg);
        background-color: #d9d9d9;
        background-size: 100%;
        background-repeat: no-repeat;
        padding: 60px 20px;
    }
    .cfx-trading-program h1 {
        font-weight: 700;
    }
    .forex-wigdet {
        margin: 90px 0;
    }
    @media (min-width: 768px) {
        .cfx-trading-program {
            padding: 60px;
        }
    }
    @media (min-width: 992px) {
        .cfx-trading-program {
            background-size: cover;
            padding: 60px;
        }
        .cfx-trading-container,
        .cfx-trading-container-bottom {
            width: 80%;
            margin: auto;
        }
    }
    @media (min-width: 1800px) {
        .cfx-trading-program {
            padding: 125px 60px;
            font-size: 1.6rem;
        }
        .cfx-trading-program h1 {
            font-size: 2.8rem;
            margin-bottom: 86px;
        }
        .cfx-trading-container {
            max-width: 70%;
            margin: auto;
        }
        .cfx-trading-container p {
            margin-left: 40px;
            margin-right: 40px;
            margin-bottom: 3.2rem;
        }
        .forex-wigdet {
            margin: 110px 0 300px;
        }
        .computer-pic {
            right: -99px;
            position: relative;
            display: block;
        }
        .cfx-trading-container-bottom h1 {
            margin-top: 46px;
            margin-bottom: 41px;
        }
    }
    .academy-top-block {
        padding: 30px;
        background-color: #f1f1f1;
        background-image: url(../img/academy-block-bg.png);
        background-repeat: no-repeat;
        background-position: right 30%;
        background-size: 100px;
    }
    .academy-top-block .highlight {
        color: #8abc57;
        font-size: 20px;
        font-weight: 400;
        text-transform: uppercase;
    }
    .academy-top-block h1 {
        font-weight: 700;
    }
    .e-learning-grid {
        display: grid;
        grid-template-columns: 1fr;
        grid-gap: 30px;
    }
    .e-learning-grid .e-learning-card {
        padding: 20px;
        background-color: #fff;
        border-radius: 22px;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
    }
    .e-learning-grid .e-learning-card .icon {
        max-width: 40%;
        margin: auto;
        margin-bottom: 20px;
    }
    @media (min-width: 768px) {
        .academy-top-block {
            padding: 60px 0;
        }
        .academy-top-block .container-fluid {
            max-width: 80%;
        }
        .e-learning-grid {
            grid-template-columns: 1fr 1fr 1fr;
            grid-gap: 40px;
        }
    }
    @media (min-width: 992px) {
        .academy-top-block {
            padding: 60px;
        }
        .academy-top-block .container-fluid {
            max-width: 90%;
        }
    }
    .e-learning-block {
        padding: 40px 30px;
    }
    .e-learning-block h1 {
        color: #8abc57;
    }
    .e-learning-block .icon {
        max-width: 60px;
        margin: auto;
        margin-bottom: 20px;
    }
    .e-learning-block .e-learning-container {
        margin: auto;
    }
    @media (min-width: 768px) {
        .e-learning-block {
            padding: 60px 0;
        }
        .e-learning-block .e-learning-container {
            width: 80%;
        }
    }
    @media (min-width: 992px) {
        .e-learning-block {
            padding: 60px 0;
        }
        .e-learning-block .e-learning-container {
            width: 75%;
        }
    }
    .start-stop {
        padding-top: 340px;
        padding-bottom: 80px;
        background-image: url(../img/round-image-guy.png);
        background-repeat: no-repeat;
        background-position: 0 0;
        background-size: 90%;
        margin-top: 30px;
    }
    .start-stop .lead {
        font-size: 25px;
    }
    @media (min-width: 768px) {
        .start-stop {
            padding-top: 30px;
            padding-bottom: 80px;
            padding-right: 20px;
            background-repeat: no-repeat;
            background-position: left 20%;
            background-size: 40%;
            margin-top: 30px;
        }
        .start-stop .lead {
            font-size: 20px;
        }
    }
    @media (min-width: 992px) {
        .start-stop {
            padding-top: 150px;
            padding-bottom: 140px;
            background-repeat: no-repeat;
            background-position: 0;
            background-size: 38%;
            margin-top: 30px;
        }
        .start-stop .lead {
            font-size: 30px;
        }
    }
    .whos-it-for {
        padding: 60px 0;
        background-image: url(../img/whos-it-for-bg.jpg);
        background-size: cover;
        background-position: 50%;
        color: #fff;
    }
    .whos-it-for .lead {
        font-size: 115%;
        font-weight: 700;
    }
    .whos-it-for .bullet-list {
        background-color: #8abc57;
        border-radius: 22px;
        padding: 30px;
    }
    .whos-it-for .bullet-list h3 {
        font-size: 130%;
        margin-bottom: 30px;
    }
    .whos-it-for .bullet-list ul {
        list-style: none;
        padding: 0;
        margin: 0;
        padding-bottom: 0;
    }
    .whos-it-for .bullet-list ul li {
        display: block;
        padding: 10px 0;
        margin-bottom: 0;
        padding-left: 50px;
        position: relative;
    }
    .whos-it-for .bullet-list ul li:after {
        font-family: FontAwesome;
        content: "\F00C";
        position: absolute;
        left: 5px;
        top: 5px;
    }
    .whos-it-for h1 {
        color: #8abc57;
    }
    .whos-it-for-container {
        position: relative;
        max-width: 80%;
        margin: auto;
    }
    @media (min-width: 992px) {
        .whos-it-for .bullet-list {
            margin-top: -80px;
            margin-bottom: -80px;
        }
        .whos-it-for .bullet-list ul {
            padding-bottom: 50px;
        }
        .whos-it-for .bullet-list ul li {
            display: block;
            padding: 10px 0;
            padding-left: 50px;
        }
    }
    .educational-benefits {
        padding: 40px;
        background-image: url(../img/benefits-bg.jpg);
        background-position: 100% 100%;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .educational-benefits .educational-benefits-container {
        max-width: 80%;
        margin: auto;
    }
    .educational-benefits .title-side {
        position: relative;
    }
    .educational-benefits .title-side h3 {
        position: relative;
        padding: 20px;
        color: #8abc57;
        font-size: 30px;
        width: 100%;
        background-image: url(../img/benefits-title-bg.png);
        background-size: contain;
        background-repeat: no-repeat;
        margin-bottom: 30px;
    }
    .educational-benefits .round-icon {
        padding: 20px;
        background: #fff;
        box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        border-radius: 50%;
        width: 100px;
        height: 100px;
        margin: auto;
        margin-bottom: 20px;
    }
    .educational-benefits strong {
        display: block;
        margin-bottom: 30px;
        line-height: 105%;
    }
    @media (min-width: 992px) {
        .educational-benefits {
            padding: 90px 90px 70px 0;
        }
        .educational-benefits .title-side h3 {
            position: relative;
            top: 50%;
            padding: 30px;
            transform: translateY(-50%);
            color: #8abc57;
            font-size: 30px;
            width: 80%;
            background-image: url(../img/benefits-title-bg.png);
            background-size: contain;
            background-repeat: no-repeat;
        }
    }
    .stat-bar {
        padding: 60px 0;
        background-image: url(../img/stat-bar-bg.png);
        background-size: 100%;
        color: #8abc57;
        font-size: 20px;
    }
    .stat-bar .stat-number {
        font-weight: 900;
        color: #fff;
        font-size: 125%;
        padding: 0;
        line-height: 100%;
    }
    .stat-bar h3 {
        color: #fff;
    }
    .together-connected {
        font-size: 20px;
        background-image: url(../img/together-connected-bg.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        padding: 60px 0;
    }
    .together-connected .container-fluid {
        max-width: 65%;
        margin: auto;
    }
    .together-connected h1 {
        font-weight: 700;
        color: #8abc57;
    }
    .together-connected h1 strong {
        font-weight: 900;
    }
    .app-preview {
        padding: 60px 0;
        background-image: url(../img/app-review-bg.png);
        background-size: cover;
        background-position: 50%;
        font-size: 20px;
    }
    .app-preview .container-fluid {
        max-width: 65%;
        margin: auto;
    }
    .app-preview h1 {
        font-weight: 700;
        font-size: 50px;
        margin-bottom: 50px;
    }
    .coming-soon {
        color: #8abc57;
        margin: 50px auto;
        display: block;
        font-size: 200%;
    }
    .testimonial-block.academy {
        background-image: url(../img/green-testimonials-bg.png);
    }
    .package-block {
        padding: 60px 30px;
        text-align: center;
        background-image: url(../img/package-bg.jpg);
        background-size: cover;
        color: #fff;
    }
    .package-block h1 {
        color: #8abc57;
    }
    .package {
        background-image: url(../img/silver-package.png);
        background-size: 100%;
        background-position: top;
        background-repeat: no-repeat;
        width: 300px;
        min-height: 500px;
        padding: 20px;
        padding-top: 230px;
        display: inline-block;
        margin: 5px;
    }
    .package-container {
        max-width: 1200px;
        margin: auto;
    }
    .package.orange {
        background-image: url(../img/orange-package.png);
        color: #000;
    }
    .package.bronze {
        background-image: url(../img/bronze-package.png);
        color: #000;
    }
    @media (min-width: 1800px) {
        .academy-top-block {
            padding: 150px 85px 120px;
        }
        .academy-top-block .highlight {
            color: #8abc57;
            font-size: 26px;
            font-weight: 400;
            margin-top: 20px;
            text-transform: uppercase;
            margin-bottom: 34px;
        }
        .academy-top-block .second-top-block {
            margin-top: 150px;
        }
        .academy-top-block .second-top-block h1 {
            margin-top: -40px;
        }
        .e-learning-block {
            padding: 75px 0;
        }
        .e-learning-block .plan-title {
            margin-bottom: 70px;
        }
        .e-learning-block .e-learning-container {
            max-width: 1700px !important;
        }
        .e-learning-block .container-fluid {
            max-width: 1700px !important;
            margin: auto;
        }
        .e-learning-block .highlight {
            font-size: 22px;
            font-weight: 500;
        }
        .e-learning-grid .e-learning-card .icon {
            margin: 27px auto;
        }
        .start-stop {
            font-size: 24px;
            padding-top: 108px;
            padding-bottom: 130px;
            background-repeat: no-repeat;
            background-position: left 11px;
            background-size: 41%;
            margin-top: 30px;
        }
        .start-stop .lead {
            font-weight: 700;
        }
        .whos-it-for {
            font-size: 24px;
        }
        .whos-it-for h1 {
            font-size: 65px;
            font-weight: 700;
            margin-bottom: 45px;
        }
        .whos-it-for .lead {
            font-size: 140%;
            font-weight: 700;
            margin-bottom: 40px;
        }
        .whos-it-for .bullet-list {
            border-radius: 55px;
            margin-right: 21px;
        }
        .whos-it-for .bullet-list ul {
            padding-bottom: 50px;
            padding-left: 50px;
            padding-right: 20px;
            font-size: 21px;
            line-height: 27px;
        }
        .whos-it-for .bullet-list h3 {
            font-size: 41px;
            margin-bottom: 30px;
            text-align: center;
            margin-top: 27px;
        }
        .educational-benefits {
            padding: 139px 128px 130px;
        }
        .educational-benefits .title-side h3 {
            position: relative;
            top: 40%;
            padding: 30px;
            transform: translateY(-50%);
            color: #8abc57;
            font-size: 54px;
            width: 100%;
            background-image: url(../img/benefits-title-bg.png);
            background-size: contain;
            background-repeat: no-repeat;
            left: -17%;
        }
        .educational-benefits .round-icon {
            margin: 33px auto;
        }
        .stat-bar {
            padding: 95px 0;
            font-size: 25px;
        }
        .stat-bar p.title {
            font-size: 30px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .stat-bar h3 {
            color: #fff;
            font-size: 41px;
        }
        .stat-bar .stat-number {
            font-size: 56px;
        }
        .together-connected {
            padding: 176px 0;
            font-size: 24px;
        }
        .together-connected h1 {
            font-weight: 700;
        }
        .together-connected h1 strong {
            font-size: 76px;
            font-weight: 900;
        }
        .together-connected h2 {
            font-size: 44px;
            font-weight: 700;
            margin-bottom: 26px;
        }
        .together-connected .container-fluid {
            max-width: 75%;
            margin: auto;
        }
        .app-preview {
            padding: 134px 0 236px;
            font-size: 25px;
        }
        .coming-soon {
            font-size: 44px;
            font-weight: 700;
            margin: 55px auto;
        }
        .app-image {
            position: absolute;
            left: -10%;
            top: 64%;
            width: 747px;
            transform: translateY(-50%);
            max-width: 747px !important;
        }
        .package-block {
            padding: 115px 0;
        }
        .package-block h1 {
            font-size: 55px;
            font-weight: 700;
            margin-bottom: 25px;
        }
        .package-block h3 {
            font-size: 39px;
            font-weight: 700;
        }
        .package-block .lead {
            font-size: 25px;
        }
        .package-block .packages {
            max-width: 1800px !important;
        }
        .package-block .package-container {
            max-width: 1800px;
            margin: auto;
        }
        .package-block .package-container .package {
            width: 500px;
            height: 800px;
            padding: 41px;
            padding-top: 430px;
            margin: 12px;
            font-size: 26px;
        }
    }
    .splash-container {
        position: relative;
        overflow: hidden;
    }
    .splash-container .splash-text-video {
        display: block;
    }
    .splash-container .video-blackout {
        background: rgba(0, 0, 0, 0.6);
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 100%;
        z-index: 1;
    }
    .splash-container .splash-bg {
        z-index: -1;
        position: static;
    }
    .splash-container .splash-bg.desktop {
        display: none;
    }
    .splash-container .splash-bg.mobile {
        display: block;
    }
    .splash-container .splash-bg img {
        width: 100%;
        max-width: 100%;
    }
    .splash-container .splash-text,
    .splash-container .splash-text-video {
        position: absolute;
        color: #fff;
        top: 50%;
        left: 50%;
        text-align: center;
        width: 100%;
        padding: 10% 0;
        text-shadow: 0 1px 0 rgba(0, 0, 0, 0.5), 0 0 12px rgba(0, 0, 0, 0.5);
        transform: translate(-50%, -50%);
        z-index: 2;
    }
    .splash-container .splash-text-video h3,
    .splash-container .splash-text h3 {
        font-size: 16px;
        font-weight: 400;
    }
    .splash-container .splash-text-video h1,
    .splash-container .splash-text h1 {
        font-size: 34px;
        line-height: 105%;
        font-weight: 900;
    }
    .splash-container .splash-text-video h1 strong,
    .splash-container .splash-text h1 strong {
        font-weight: 900;
    }
    .splash-container .splash-text-video .btn,
    .splash-container .splash-text .btn {
        padding: 10px 20px;
        margin-top: 20px;
        text-shadow: none;
    }
    @media (min-width: 768px) {
        .splash-container .splash-text h3 {
            font-size: 30px;
        }
        .splash-container .splash-text h1 {
            font-size: 44px;
        }
    }
    @media (min-width: 992px) {
        .splash-container .splash-bg.desktop {
            display: block;
        }
        .splash-container .splash-bg.mobile {
            display: none;
        }
        .splash-container .splash-text-video h3,
        .splash-container .splash-text h3 {
            font-size: 50px;
        }
        .splash-container .splash-text-video h1,
        .splash-container .splash-text h1 {
            font-size: 64px;
        }
        .splash-container .splash-text-video .btn,
        .splash-container .splash-text .btn {
            padding: 14px 25px;
            margin-top: 20px;
            text-shadow: none;
            border-radius: 55px;
        }
    }
    @media (min-width: 992px) {
        .splash-container .splash-text {
            font-size: 30px;
        }
        .splash-container .splash-text h3 {
            font-size: 50px;
        }
        .splash-container .splash-text h1 {
            margin-top: 20px;
            font-size: 77px;
        }
    }
    @media (min-width: 1800px) {
        .splash-container .splash-text-video .btn,
        .splash-container .splash-text .btn {
            font-size: 25px;
            padding: 10px 30px;
            border-radius: 55px;
            margin-top: 20px;
            text-shadow: none;
        }
    }
.bb_button {
  border: 1px solid #fff;
  text-decoration: none;
  position: relative;
  z-index: 1;
  border-radius: 8px;
  padding: 10px;
}

</style>
@endsection
@extends('layouts.app')
@section('sub')
<div class="banner banner-static">
    <div class="banner-cpn">
        <div class="container">
            <div class="content row">

                <div class="banner-text">
                    <h1 class="page-title">About Us</h1>
                    <p>Know about us today</p>						
                </div>
                <div class="page-breadcrumb">
                    <ul class="breadcrumb">
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li class="active"><span>About Us</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>
    <div class="banner-bg imagebg" style="box-shadow:inset 0 0 0 2000px #3c763dad">
        <img src="frontend/image/banner-inside-a.jpg" alt="" />
    </div>
</div>
@endsection
@section('content')
<!-- Content -->
<!-- Service Section -->
<div class="section section-services" style="  background: #222;">
    <div class="container">
        <div class="content row">
            <!-- Feature Row  -->
            <div class="row feature-s4 off-text boxed-filled boxed-w"style="  background: #222;" >
                <div class="heading-box clearfix" style="  background: #222;">
                    <div class="col-sm-5" style="  background: #222;">
                        <h2 class="heading-section" style="color:#89b55dbf">FINANCIAL RESPONSIBILITY STARTS WITH US
                        </h2>
                    </div>
                    <div class="col-sm-6 col-sm-offset-1" style="  background: #222;">
                        <span class="text-white" style="color:#fff">In cobitfx, the impossible becomes possible with our deeper insight in the forex market . Giving you financial freedom is all we do.</span>
                    </div>
                </div>




            </div>
            <!-- Feture Row  #end -->

        </div>
    </div>
</div>
<div class="section section-contents section-pad" style="  background: #222;">
    <div class="container">
        <div class="content row row-vm" style="  color: #fff!important;">

            <div class="col-sm-7">
                <h2 class="heading-lg" style="margin-top:-50px;color:#fff">WHO WE ARE</h2>
                <p class="lead">Cobitfx is a universally recognized FX institute that provides trading education, trading signals, and comprehensive market analysis for aspiring and professional traders. Our invaluable service has earned us numerous awards from different institutions throughout the world. 

                </p>
                <p>
                    We provide market analysis and market movement. We give insight into the socio-economic, political, and technical components that drive the forex market.
                </p>
                <p>
                    We offer professional advice, reliable, tested, and trusted trading signals and techniques to make you trade Forex like a pro.
                </p>
                <p>
                    We recommend trading tools, guidance, pros and cons on forex trading. 
                </p>
                <p>
                    To trade successfully, one needs experience, knowledge, and disciplined trading habits.
                </p>
                <p>
                    We offer investment partners that can multiply your money without any physical efforts with ROI.
                </p>
                <p>
                    We are certified by necessary trading institutions. </p> 

            </div>
            <div class="col-sm-5 ">
                <img class="img-shadow" alt="" src="frontend/image/photo-sm-a.jpg" style="height:100%;width:100% !important">
            </div>

        </div>


        <div class="text-center">

            <div class="platform-computer" style="  color: #fff!important;">
                <img src="frontend/image/platform-computer.png" class="computer-image" alt=" trading platform">

                <div class="platform-features">
                    <div class="platform-feature fast-payments">
                        <div class="platform-icon">
                            <img src="frontend/image/value.png" alt="Core values"></div>
                        <h1 style="color:#89b55dbf">Core values</h1>
                        <p>We valued transparency, accountability, and integrity.</p>
                    </div>

                    <div class="platform-feature layered-security">
                        <div class="platform-icon"><img src="frontend/image/pu.png" alt="Purpose">
                        </div>
                        <h1 style="color:#89b55dbf">Purpose</h1>
                        <p>We aim to raise thousands of people through our learning platform that can trade and analyze profitably, which will enhance financial freedom from those individuals to their families and communities.</p>
                    </div>

                    <div class="platform-feature proprietary-tech">
                        <div class="platform-icon">
                            <img src="frontend/image/mission.png" alt="Mission">
                        </div>
                        <h1 style="color:#89b55dbf">Mission</h1>
                        <p>To be a platform where people learn, earn, and become financially independent. This can be accomplished by using our sophisticated Artificial Intelligence software/tools to analyze and forecast the Forex market
                        </p>
                    </div>

                    <div class="platform-feature transparent-reporting">
                        <div class="platform-icon">
                            <img src="frontend/image/g.png" alt="Goal">
                        </div>
                        <h1 style="color:#89b55dbf">Goal</h1>
                        <p>To be one of the top-five Forex learning institutions in the world.
                        </p>
                    </div>
                </div>
            </div>
        </div>




    </div>
</div>

<div class="faqs-section section-pad" style="background-image: url(frontend/image/our.jpg); 
     background-size: cover;box-shadow:inset 0 0 0 2000px #252728b8">
    <div class="container">
        <div class="row">
            <h2 class="heading-lg" style="color:#fff">Our work</h2>
            <p style="color:#fff">Cobitfx already uses the advantages of artificial intelligence software(A.I) to gain serious advantage and security over users funds in the forex market. This implementations allowed to significantly improve the accuracy of analytical data acquired used for development, set up and adjustments of algorithmic systems, and as well as generally improve the efficiency of platform operations.</p>

        </div>
    </div>
</div>
<!-- End content -->

<div class="faqs-section section-pad">
    <div class="container">
        <div class="row">

            <div class="wide-md">
               
  <div class="" style="background:#009750;padding:4px;border-radius: 4px;text-align: center!important">
      <br>
      <p class=""style="color:#fff !important">Curious to know more about our company? <span style="opacity:0.5">Have a look on here………</span>
          &nbsp;  &nbsp; <a href="{{url('pdf')}}" style="color:#fff"><span class="bb_button bb_button--transparent">Download Brochure</span></a></p>
                <div class="gaps size-sm"></div>
        
            </div>

<br>
                <div class="" style="background:#009750;padding:20px;border-radius: 4px">
                    <h2 class="center" style="color:#fff !important">Frequently Answers &amp; Questions</h2>
                <p class="center"style="color:#fff !important">These are just some of the most common questions we get asked. For anything else, please contact us.</p>
                <div class="gaps size-sm"></div>
        
            </div>
                      <br>      <br>
                <!-- Accordion -->
                <div class="panel-group accordion" id="another" role="tablist" aria-multiselectable="true">
                    <!-- each panel for accordion -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="accordion-i1">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#another" href="#accordion-pane-i1" aria-expanded="false">
                                    What is {{$settings['site_name']}}?
                                    <span class="plus-minus"><span></span></span>
                                </a>
                            </h4>
                        </div>
                        <div id="accordion-pane-i1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-i1">
                            <div class="panel-body">
                             Cobitfx is an organisation that provides Forex trading opportunity for its user. We help 
                             our user to become Forex expert with our learning platform. Besides that, Cobitfx offers investment plans for our members which gives a return 5.7% within the contractual period.  
                            
                            
                            </div>
                        </div>
                    </div> 
                    <!-- each panel for accordion -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="accordion-i2">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#another" href="#accordion-pane-i2" aria-expanded="false">
                                    Who controls the investment Portfolio?
                                    <span class="plus-minus"><span></span></span>
                                </a>
                            </h4>
                        </div>
                        <div id="accordion-pane-i2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-i2">
                            <div class="panel-body">
                               Our investment portfolio is control by seasonal trading and financial experts, who have vast knowledge in Foreign Exchanges. Cobitfx can boost of the best trading analysts who can accurately predict the market movement. Funds are managed and controlled by our top-rated experts with the help of our sophisticated software. </div>
                        </div>
                    </div>
                    <!-- each panel for accordion -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="accordion-i3">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#another" href="#accordion-pane-i3" aria-expanded="false">
                                    What are the risks for my investment?
                                    <span class="plus-minus"><span></span></span>
                                </a>
                            </h4>
                        </div>
                        <div id="accordion-pane-i3" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-i3">
                            <div class="panel-body">
                               Every busines/investment has an element of risk, and this is applied to Cobitfx, however, we have set aside a stabilization fund where we can always indemnify our users when things go unexpected due to external threat. With us, the safety of our fund is guaranteed. </div>
                        </div>
                    </div>
                    <!-- each panel for accordion -->
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="accordion-i4">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#another" href="#accordion-pane-i4" aria-expanded="false">
                                    Do you accept clients from all over the world?
                                    <span class="plus-minus"><span></span></span>
                                </a>

                            </h4>
                        </div>
                        <div id="accordion-pane-i4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-i4">
                            <div class="panel-body">
                             As a leading international platform; Cobitfx accepts clients and users from every part of the world. Your location can never pose a threat in joining us.   </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="accordion-i5">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#another" href="#accordion-pane-i5" aria-expanded="false">
                                    What tax am I subjected to?
                                    <span class="plus-minus"><span></span></span>
                                </a>

                            </h4>
                        </div>
                        <div id="accordion-pane-i5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-i5">
                            <div class="panel-body">
                          Cobitfx doesn't offer tax advice, you are not  subjected to any tax. </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="accordion-i6">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#another" href="#accordion-pane-i6"
                                   aria-expanded="false">
                                    How long it take to process transactions?
                                    <span class="plus-minus"><span></span></span>
                                </a>

                            </h4>
                        </div>
                        <div id="accordion-pane-i6" class="panel-collapse collapse" role="tabpanel" aria-labelledby="accordion-i6">
                            <div class="panel-body">
                               We process transactions immediately, meanwhile, the speed of the transaction might depend on the payment method. </div>
                        </div>
                    </div>
                    <!-- end each panel -->
                </div>
                <!-- Accordion #end -->
            </div>

        </div>
    </div>
</div>
@endsection