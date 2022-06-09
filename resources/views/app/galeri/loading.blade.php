<h4 class="mb-2">Gallery</h4>
<div class="d-flex justify-content-evenly flex-wrap">
    @foreach($data as $photo)
    <div class="border mb-2 p-2" style="width: fit-content">
        <a
            data-fslightbox="gallery"
            href="{{ route('file-show-photo',$photo->path_file) }}"
        >
            <img
                src="{{ route('file-show-photo',$photo->path_file) }}"
                width="100"
                alt=""
            />
        </a>
    </div>
    @endforeach
</div>
<script src="{{
    asset('assets/plugins/fslightbox-basic-3.3.1/fslightbox.js')
}}"></script>
<script>