<?php 

include_once (APP_PATH . '/components/elements/customInput.php');
include_once (APP_PATH . '/components/elements/popup.php');

function form($pageTitle, $data) {
    $video = $data['video'] ?? null;
    $tags = $data['tags'] ?? [];
?>
    <div>
        <span class="page-title"><?=$pageTitle?></span>
        <form class="flex flex-row items-center upload-form" onsubmit="<?= $video ? 'updateVideo(event, ' . $video->video_id . ', \'popup-update-video\')' : 'uploadVideo(event, \'popup-upload-video\')'?>">
            <div class="flex main-segment w-full">
                <div class="file-segment flex flex-row justify-between items-center">
                    <?php if ($video) : ?>
                        <video src="<?=$video->video_file?>" controls></video>
                    <?php endif; ?>
                    <?php if (!$video) : ?>
                        <label class="upload-box video-upload-box">
                            <input onchange="<?='onVideoChange(event, ' . ($video ? 'true' : 'false') .  ')'?>" type="file" name="video_file" accept="<?=implode(', ', ALLOWED_VIDEOS)?>" hidden/>
                            <div class="upload-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l3 3m-3-3l-3 3M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                            </svg>
                            </div>
                            <div class="video-file-desc-container flex flex-col justify-center">
                                <span class="desc video-file-desc">Upload your video here</span>
                            </div>
                            <span class="blue-button">Select Files</span>
                        </label>
                    <?php endif; ?>
                    <div class="flex flex-row thumbnail-segment">
                        <span class="input-label">Thumbnail <span class="required">*</span></span>
                        <div class="flex flex-col thumbnail-file-segment">
                            <label class="upload-box thumbnail-upload-box">
                                <input onchange="onThumbnailChange(event)" type="file" name="thumbnail" accept="<?=implode(', ', ALLOWED_IMAGES)?>" hidden/>
                                <div class="upload-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                </svg>
                                </div>
                                <span class="desc">Upload Thumbnail</span>
                            </label>

                            <div class="thumbnail-image">
                                <?php if ($video) : ?>
                                    <img id="thumbnail-preview" alt="thumbnail-preview" src="<?=$video->thumbnail?>" />
                                <?php endif; ?>
                                <?php if (!$video) : ?>
                                    <div class="no-thumbnail-text flex flex-col items-center justify-center">
                                        <span class="no-thumbnail-text">No File Selected</span>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-row input-segment">
                    <?php 
                        customInput(
                            "text",
                            "title",
                            required: true,
                            placeholder: "My Video",
                            inputLabel: "Title",
                            defaultValue: $video ? $video->title : ''
                        );
                    ?>

                    <?php 
                        customInput(
                            "textarea",
                            "video_desc",
                            placeholder: "This is my video",
                            inputClasses:"desc-input",
                            inputLabel: "Description",
                            defaultValue: $video ? $video->video_desc : ''
                        );
                    ?>

                    <?php 
                        customInput(
                            "textarea",
                            "tags",
                            placeholder: "Gaming, Valorant",
                            inputClasses: "tags-input",
                            inputLabel: "Tags",
                            defaultValue: implode(', ', $tags)
                        );
                    ?>
                </div>

            </div>
            <button class="blue-button upload-button" type="submit"><?=$video? 'Update Video' : 'Upload Video'?></button>
        </form>

        <?php
            popup('Upload Video', 'Are you sure you want to upload this video?', 'upload-video', "Upload", actionButtonClass: 'popup-save-button');
            popup('Upload Video', 'Are you sure you want to update this video?', 'update-video', "Update", actionButtonClass: 'popup-save-button') 
        ?>
    </div>

<?php
}