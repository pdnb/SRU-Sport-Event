<div>
    <iframe src="https://drive.google.com/file/d/{{ $googleDriveFileId }}/preview" class="w-full h-screen" allow="autoplay" style="display: none;" onload="this.style.display = 'block'; document.getElementById('skeleton').style.display = 'none';"></iframe>
    <div class="flex flex-col gap-4 w-full" id="skeleton">
        <div class="skeleton h-32 w-full"></div>
        <div class="skeleton h-4 w-28"></div>
        <div class="skeleton h-4 w-full"></div>
        <div class="skeleton h-4 w-full"></div>
    </div>
</div>
