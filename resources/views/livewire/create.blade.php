<form wire:submit.prevent="store">
    <div class="form-group">
        <label for="exampleFormControlInput1">Name:</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Name"
            wire:model="name">
        @error('name') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput2">Grade:</label>
        <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Enter Grade"
            wire:model="grade">
        @error('grade') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput3">Department:</label>
        <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="Enter Department"
            wire:model="department">
        @error('department') <span class="text-danger">{{ $message }}</span>@enderror
    </div>
    <div class="form-group">
        <label for="exampleFormControlInput3">Picture:</label>
        <x-input.filepond wire:model="picture" />
    </div>
    <button class="btn btn-success" type="submit">Save</button>
</form>
