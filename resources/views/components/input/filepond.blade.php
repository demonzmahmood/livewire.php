<div wire:ignore x-data x-init="
FilePond.setOptions({
    server: {
        process: (fieldName, file, metadata, load, error, progress, abort, transfer, options)=>{
            @this.upload('picture', file, load, error, progress)
        },
        revert: (filename, load) => {
            @this.removeUpload('picture', filename, load)
            },
        },
    });
    FilePond.create($refs.input);
    ">
<input type="file" x-ref="input">
</div>
