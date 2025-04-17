<!-- Header Section Begin -->

<script src="https://kit.fontawesome.com/442fcb757c.js" crossorigin="anonymous"></script>

<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="./index.php">
                        <img src="img/Anime Series.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="./index.php">Homepage</a></li>

                            
                            <li><a target="_blank" href="https://v0-search-anime.vercel.app/">AI Suggestion</a></li>
                            

                            <li><a href="./categories.html">Categories <span class="arrow_carrot-down"></span></a>
                                <ul class="dropdown">
                                    <li><a href="./categories.html">Categories</a></li>
                                    <li><a href="./anime-details.html">Anime Details</a></li>
                                    <li><a href="./anime-watching.html">Anime Watching</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>

                                    <li><a href="./signup.html">Sign Up</a></li>
                                    <li><a href="./login.html">Login</a></li>

                                </ul>
                            </li>
                            <li><a href="./blog.html">Our Blog</a></li>
                            <li><a href="contacts.html">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="header__right">
                    <div class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" aria-expanded="false" href="#"><i
                                class="fa-solid fa-cart-shopping"></i>
                        </a> <!-- icon cart -->
                        <div class="dropdown-menu">
                                    <label class="text-primary ml-2">
                                        Preview New Movies When You Become a Member
                                    </label>
                            <!-- VIP Normal -->
                            <a class="d-flex justify-content-between dropdown-item text-dark" href="#">
                                <span>
                                    <div class="vip-badge">VIP Normal-<i class="fa-solid fa-crown mx-9"
                                            style="font-size: 16px;"></i></div> <!-- Add VIP badge here -->
                                </span>
                                <span>
                                    <label class="form-VIP-Normal my-1 ml-0 text-primary" for="vip-badge">
                                        Package Week
                                    </label>
                                </span>
                            </a>
                            </a>
                            <div class="form-check align-items-center">
                                <input class="form-check-input ml-2" type="checkbox" value="" id="checkbox1">
                                <label class="form-check-label mx-4 mb-2" for="checkbox1">
                                    1 Week - 2$
                                </label>
                            </div>
                            <button type="button" class="btn btn-primary mt-0 ml-4 d-none buyBtn" id="buyBtn1">Buy
                                Now</button>
                            <div class="form-check align-items-center">
                                <input class="form-check-input ml-2" type="checkbox" value="" id="checkbox2">
                                <label class="form-check-label mx-4 mb-2" for="checkbox2">
                                    2 Week - 4$
                                </label>
                            </div>
                            <button type="button" class="btn btn-primary mt-0 ml-4 d-none buyBtn" id="buyBtn2">Buy
                                Now</button>
                            <div class="form-check align-items-center">
                                <input class="form-check-input ml-2" type="checkbox" value="" id="checkbox3">
                                <label class="form-check-label mx-4 mb-2" for="checkbox3">
                                    3 Week - 6$
                                </label>
                            </div>
                            <button type="button" class="btn btn-primary mt-0 ml-4 d-none buyBtn" id="buyBtn3">Buy
                                Now</button>
                            <!-- VIP Premium -->
                            <a class="d-flex justify-content-between dropdown-item text-dark" href="#">
                                <span>
                                    <div class="vip-badge">VIP Premium-<i class="fa-solid fa-crown mx-9"
                                            style="font-size: 16px;"></i></div> <!-- Add VIP badge here -->
                                </span>
                                <span>
                                    <label class="form-VIP-Premium my-1 ml-4 text-primary" for="vip-badge">
                                        Package Month
                                    </label>
                                </span>
                            </a>
                            </a>
                            <div class="form-check align-items-center">
                                <input class="form-check-input ml-2" type="checkbox" value="" id="checkbox4">
                                <label class="form-check-label mx-4 mb-2" for="checkbox4">
                                    1 Month - 8$
                                </label>
                            </div>
                            <button type="button" class="btn btn-primary mt-0 ml-4 d-none buyBtn" id="buyBtn4">Buy
                                Now</button>
                            <div class="form-check align-items-center">
                                <input class="form-check-input ml-2" type="checkbox" value="" id="checkbox5">
                                <label class="form-check-label mx-4 mb-2" for="checkbox5">
                                    2 Month - 14.5$
                                </label>
                            </div>
                            <button type="button" class="btn btn-primary mt-0 ml-4 d-none buyBtn" id="buyBtn5">Buy
                                Now</button>
                            <div class="form-check align-items-center">
                                <input class="form-check-input ml-2" type="checkbox" value="" id="checkbox6">
                                <label class="form-check-label mx-4 mb-2" for="checkbox6">
                                    3 Month - 21.5$
                                </label>
                            </div>
                            <button type="button" class="btn btn-primary mt-0 ml-4 d-none buyBtn" id="buyBtn6">Buy
                                Now</button>
                            <a class="dropdown-item text-dark" href="#">Membership Package-<i
                                    class="fa-solid fa-users-line"></i></a>
                            <a class="dropdown-item text-dark" href="#">Skip Ads Package-<i
                                    class="fa-solid fa-forward"></i></a>
                        </div>
                        <script>
                            // Get all checkboxes
                            var checkboxes = document.querySelectorAll('.form-check-input');

                            // Loop through each checkbox to add a change event
                            checkboxes.forEach(function (checkbox, index) {
                                checkbox.addEventListener('change', function () {
                                    // Find the Buy Now button corresponding to the checkbox
                                    var buyBtn = document.getElementById('buyBtn' + (index + 1));
                                    // Show the Buy Now button if the checkbox is selected, otherwise hide the Buy Now button
                                    buyBtn.classList.toggle('d-none', !this.checked);
                                });
                            });
                        </script>
                        <style>
                            /* Custom CSS to add space around the Buy Now button */
                            #buyBtn {
                                margin-top: 8px;
                                /* Adjust this value as needed */
                            }
                        </style>
                        <style>
                            .dropdown-menu {
                                transform: translateX(-60%);
                                left: 50%;
                            }
                        </style>
                    </div>
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
                    <a href="./login.html"><span class="icon_profile"></span></a>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header> 



<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Box AI</title>
    <style>
        /* Định dạng icon chat */
        .chat-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            background-color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            animation: glow 1.5s infinite alternate;
        }

        .chat-icon img {
            width: 60%; /* Điều chỉnh kích thước ảnh */
            height: 80%;
            object-fit: contain;
            border-radius: 50%;
        }

        /* Hiệu ứng phát sáng */
        @keyframes glow {
            0% {
                box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
            }
            100% {
                box-shadow: 0 0 20px rgba(0, 123, 255, 1), 0 0 30px rgba(0, 123, 255, 0.8);
            }
        }

        /* Định dạng hộp chat */
        .chat-box {
            position: fixed;
            bottom: 90px;
            right: 20px;
            width: 400px;
            height: 600px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: none;
            overflow: hidden;
            z-index: 999;
        }

        /* Định dạng iframe */
        .chat-box iframe {
            width: 100%;
            height: 100%;
            border: none;
        }
    </style>
</head>
<body>

    <!-- Icon chat bằng hình ảnh -->
    <div class="chat-icon" id="chatIcon" onclick="toggleChat()">
        <img src="img/robot.png" alt="Chat Bot">
    </div>

    <!-- Hộp chat chứa iframe -->
    <div class="chat-box" id="chatBox">
        <iframe src="https://v0-search-anime.vercel.app/"></iframe>
    </div>

    <script>
        function toggleChat() {
            var chatBox = document.getElementById("chatBox");
            var chatIcon = document.getElementById("chatIcon");

            if (chatBox.style.display === "none" || chatBox.style.display === "") {
                chatBox.style.display = "block";
                chatIcon.style.animation = "none"; // Tắt hiệu ứng khi chatbox mở
            } else {
                chatBox.style.display = "none";
                chatIcon.style.animation = "glow 1.5s infinite alternate"; // Bật lại hiệu ứng khi chatbox đóng
            }
        }
    </script>

</body>
</html>


<!-- Header End -->