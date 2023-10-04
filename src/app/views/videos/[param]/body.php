<?php
function body($data) {
?>
    <div>
        <div class="flex">
            <div class="w-full">
                <video class="w-full" controls>
                    <source src="movie.mp4" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>   
        </div>
        
        <div class="my-2">
            <h2 class="text-bold">Soothing 24-hour playlist of jazz music for work</h2>
            <h3 class="my-1 text-bold text-grey flex align-center">Official Video	
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 72 72">
                    <path fill="#808080" d="M36,12c13.234,0,24,10.766,24,24c0,13.234-10.766,24-24,24S12,49.234,12,36	C12,22.766,22.766,12,36,12z M46.362,32.878c0.781-0.781,0.781-2.047,0-2.828c-0.781-0.781-2.047-0.781-2.828,0l-9.121,9.121	l-5.103-5.103c-0.781-0.781-2.047-0.781-2.828,0c-0.781,0.781-0.781,2.047,0,2.828l6.517,6.517C33.374,43.789,33.883,44,34.413,44	s1.039-0.211,1.414-0.586L46.362,32.878z"></path>
                </svg>
            </h3>
            <h4 class="my-1 text-grey flex align-center">Uploaded 25/09/2023</h4>	
        </div>

        <h3 class="text-bold mt-5 mb-2">Description</h3>
        <div class="video-desc">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ultricies, eros sollicitudin facilisis auctor, massa risus auctor odio, ac suscipit dui augue commodo ipsum. Cras orci quam, convallis vitae felis et, dignissim viverra lectus. Sed mi est, pharetra ut fringilla id, sollicitudin a est. Fusce condimentum mauris purus, quis dignissim purus porta non. Etiam lobortis consequat placerat. Suspendisse vel feugiat ipsum. Praesent viverra arcu lacus, quis cursus diam fermentum at. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget pulvinar mi, vel porttitor orci. Mauris ut metus varius, iaculis erat quis, pulvinar libero. Duis tincidunt egestas risus id molestie.Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ultricies, eros sollicitudin facilisis auctor, massa risus auctor odio, ac suscipit dui augue commodo ipsum. Cras orci quam, convallis vitae felis et, dignissim viverra lectus. Sed mi est, pharetra ut fringilla id, sollicitudin a est. Fusce condimentum mauris purus, quis dignissim purus porta non. Etiam lobortis consequat placerat. Suspendisse vel feugiat ipsum. Praesent viverra arcu lacus, quis cursus diam fermentum at. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget pulvinar mi, vel porttitor orci. Mauris ut metus varius, iaculis erat quis, pulvinar libero. Duis tincidunt egestas risus id molestie.</p>
        </div>
        
        <h3 class="text-bold mt-5 mb-2">Comments</h3>

        <div class="">

            <form>
                <div class="flex">
                    <div class="w-big">
                        <div class="form-group">
                            <input type="text" autocomplete="off" id="name" name="name" placeholder="Type your comment here">
                        </div>
                    </div>
                    <div class="w-small">
                        <input class=" float-end"  type="submit" value="Submit">
                    </div>
                </div>
            </form>

            <div class="comment-box my-2">
                <h4 class="text-bold">@helloworld</h4>
                <h5 class="text-grey">26/09/2023 7:45PM</h5>
                <p class="pt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="comment-box my-2">
                <h4 class="text-bold">@helloworld</h4>
                <h5 class="text-grey">26/09/2023 7:45PM</h5>
                <p class="pt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
            <div class="comment-box my-2">
                <h4 class="text-bold">@helloworld</h4>
                <h5 class="text-grey">26/09/2023 7:45PM</h5>
                <p class="pt-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
            </div>
        </div>
        

    </div>
 <?php 
}