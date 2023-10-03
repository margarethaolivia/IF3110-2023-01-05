<?php

include_once (APP_PATH . '/components/template/pagination.php');
include_once APP_PATH . '/components/elements/popup.php';

function body($data) {
?>
    <main class="pb-2">
        <div class="flex items-center">
            <div class="w-big">
                <div class="scrollmenu">
                    <span class="badge p-2 mtbr-2">Music</span>
                    <span class="badge p-2 mtbr-2">Animation</span>
                    <span class="badge p-2 mtbr-2">Drama</span>
                    <span class="badge p-2 mtbr-2">Education</span>
                    <span class="badge p-2 mtbr-2">Music</span>
                    <span class="badge p-2 mtbr-2">Animation</span>
                    <span class="badge p-2 mtbr-2">Drama</span>
                    <span class="badge p-2 mtbr-2">Education</span>
                    <span class="badge p-2 mtbr-2">Music</span>
                    <span class="badge p-2 mtbr-2">Animation</span>
                    <span class="badge p-2 mtbr-2">Drama</span>
                    <span class="badge p-2 mtbr-2">Education</span>
                    <span class="badge p-2 mtbr-2">Music</span>
                    <span class="badge p-2 mtbr-2">Animation</span>
                    <span class="badge p-2 mtbr-2">Drama</span>
                    <span class="badge p-2 mtbr-2">Education</span>
                    <span class="badge p-2 mtbr-2">Music</span>
                    <span class="badge p-2 mtbr-2">Animation</span>
                    <span class="badge p-2 mtbr-2">Drama</span>
                    <span class="badge p-2 mtbr-2">Education</span>
                </div>
            </div>
            <div class="w-small">
                <span class="sort-button">Sort</span>
            </div>
        </div>
        
        <section id="video-list" class="mb-2">
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-small">
                        <img class="radius-50 m-10px" src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar">

                    </div>
                    <div class="w-big ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        <span class="my-1 text-bold text-grey flex align-center">Official Video	
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 72 72">
                                <path fill="#808080" d="M36,12c13.234,0,24,10.766,24,24c0,13.234-10.766,24-24,24S12,49.234,12,36	C12,22.766,22.766,12,36,12z M46.362,32.878c0.781-0.781,0.781-2.047,0-2.828c-0.781-0.781-2.047-0.781-2.828,0l-9.121,9.121	l-5.103-5.103c-0.781-0.781-2.047-0.781-2.828,0c-0.781,0.781-0.781,2.047,0,2.828l6.517,6.517C33.374,43.789,33.883,44,34.413,44	s1.039-0.211,1.414-0.586L46.362,32.878z"></path>
                            </svg>
                        </span>
                        <p class="my-1">Uploaded 25/09/2023</p>
                    </div>
                </div>
                
            </div>
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-small">
                        <img class="radius-50 m-10px" src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar">

                    </div>
                    <div class="w-big ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        <span class="my-1 text-bold text-grey flex align-center">Official Video	
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 72 72">
                                <path fill="#808080" d="M36,12c13.234,0,24,10.766,24,24c0,13.234-10.766,24-24,24S12,49.234,12,36	C12,22.766,22.766,12,36,12z M46.362,32.878c0.781-0.781,0.781-2.047,0-2.828c-0.781-0.781-2.047-0.781-2.828,0l-9.121,9.121	l-5.103-5.103c-0.781-0.781-2.047-0.781-2.828,0c-0.781,0.781-0.781,2.047,0,2.828l6.517,6.517C33.374,43.789,33.883,44,34.413,44	s1.039-0.211,1.414-0.586L46.362,32.878z"></path>
                            </svg>
                        </span>
                        <p class="my-1">Uploaded 25/09/2023</p>
                    </div>
                </div>
                
            </div>
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-small">
                        <img class="radius-50 m-10px" src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar">

                    </div>
                    <div class="w-big ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        <span class="my-1 text-bold text-grey flex align-center">Official Video	
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 72 72">
                                <path fill="#808080" d="M36,12c13.234,0,24,10.766,24,24c0,13.234-10.766,24-24,24S12,49.234,12,36	C12,22.766,22.766,12,36,12z M46.362,32.878c0.781-0.781,0.781-2.047,0-2.828c-0.781-0.781-2.047-0.781-2.828,0l-9.121,9.121	l-5.103-5.103c-0.781-0.781-2.047-0.781-2.828,0c-0.781,0.781-0.781,2.047,0,2.828l6.517,6.517C33.374,43.789,33.883,44,34.413,44	s1.039-0.211,1.414-0.586L46.362,32.878z"></path>
                            </svg>
                        </span>
                        <p class="my-1">Uploaded 25/09/2023</p>
                    </div>
                </div>
                
            </div>
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-small">
                        <img class="radius-50 m-10px" src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar">

                    </div>
                    <div class="w-big ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        <span class="my-1 text-bold text-grey flex align-center">Official Video	
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 72 72">
                                <path fill="#808080" d="M36,12c13.234,0,24,10.766,24,24c0,13.234-10.766,24-24,24S12,49.234,12,36	C12,22.766,22.766,12,36,12z M46.362,32.878c0.781-0.781,0.781-2.047,0-2.828c-0.781-0.781-2.047-0.781-2.828,0l-9.121,9.121	l-5.103-5.103c-0.781-0.781-2.047-0.781-2.828,0c-0.781,0.781-0.781,2.047,0,2.828l6.517,6.517C33.374,43.789,33.883,44,34.413,44	s1.039-0.211,1.414-0.586L46.362,32.878z"></path>
                            </svg>
                        </span>
                        <p class="my-1">Uploaded 25/09/2023</p>
                    </div>
                </div>
                
            </div>
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-small">
                        <img class="radius-50 m-10px" src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar">

                    </div>
                    <div class="w-big ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        <span class="my-1 text-bold text-grey flex align-center">Official Video	
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 72 72">
                                <path fill="#808080" d="M36,12c13.234,0,24,10.766,24,24c0,13.234-10.766,24-24,24S12,49.234,12,36	C12,22.766,22.766,12,36,12z M46.362,32.878c0.781-0.781,0.781-2.047,0-2.828c-0.781-0.781-2.047-0.781-2.828,0l-9.121,9.121	l-5.103-5.103c-0.781-0.781-2.047-0.781-2.828,0c-0.781,0.781-0.781,2.047,0,2.828l6.517,6.517C33.374,43.789,33.883,44,34.413,44	s1.039-0.211,1.414-0.586L46.362,32.878z"></path>
                            </svg>
                        </span>
                        <p class="my-1">Uploaded 25/09/2023</p>
                    </div>
                </div>
                
            </div>
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-small">
                        <img class="radius-50 m-10px" src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar">

                    </div>
                    <div class="w-big ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        <span class="my-1 text-bold text-grey flex align-center">Official Video	
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 72 72">
                                <path fill="#808080" d="M36,12c13.234,0,24,10.766,24,24c0,13.234-10.766,24-24,24S12,49.234,12,36	C12,22.766,22.766,12,36,12z M46.362,32.878c0.781-0.781,0.781-2.047,0-2.828c-0.781-0.781-2.047-0.781-2.828,0l-9.121,9.121	l-5.103-5.103c-0.781-0.781-2.047-0.781-2.828,0c-0.781,0.781-0.781,2.047,0,2.828l6.517,6.517C33.374,43.789,33.883,44,34.413,44	s1.039-0.211,1.414-0.586L46.362,32.878z"></path>
                            </svg>
                        </span>
                        <p class="my-1">Uploaded 25/09/2023</p>
                    </div>
                </div>
                
            </div>
        </section>
        <?php 
            pagination(10);
        ?>
    </main>
<?php
}