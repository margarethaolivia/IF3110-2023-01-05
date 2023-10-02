<?php

include_once (__DIR__ . '/../../components/template/pagination.php');

function body($data) {
?>
    <main class="pb-2">
        <div class="flex items-center">
            <div class="w-big">
                <h2 class="text-bold">My Videos</h2>
            </div>
            <div class="w-small">
                <span class="black-button">Upload</span>
            </div>
        </div>
        
        <section id="video-list" class="mb-2">
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-full ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        
                        <div class="flex justify-between items-center">
                            <p class="my-1">Uploaded 25/09/2023</p>
                            <button class="black-button-outline">Edit</button>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-full ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        
                        <div class="flex justify-between items-center">
                            <p class="my-1">Uploaded 25/09/2023</p>
                            <button class="black-button-outline">Edit</button>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-full ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        
                        <div class="flex justify-between items-center">
                            <p class="my-1">Uploaded 25/09/2023</p>
                            <button class="black-button-outline">Edit</button>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-full ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        
                        <div class="flex justify-between items-center">
                            <p class="my-1">Uploaded 25/09/2023</p>
                            <button class="black-button-outline">Edit</button>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-full ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        
                        <div class="flex justify-between items-center">
                            <p class="my-1">Uploaded 25/09/2023</p>
                            <button class="black-button-outline">Edit</button>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="video-card">
                <img src="https://t4.ftcdn.net/jpg/05/18/69/85/360_F_518698520_Xk9tIwoYpyX6kkVsF6GpQ1z7sKXO8YRz.jpg" alt="Video Thumbnail">
                <div class="flex">
                    <div class="w-full ml-2">
                        <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
                        
                        <div class="flex justify-between items-center">
                            <p class="my-1">Uploaded 25/09/2023</p>
                            <button class="black-button-outline">Edit</button>
                        </div>
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