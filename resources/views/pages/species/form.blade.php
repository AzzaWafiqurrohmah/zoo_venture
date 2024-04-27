@php
    $species = isset($species) ? $species : null;
@endphp

@csrf
<div class="card mb-3">
    <div class="card-body">
        <h5 style="margin-bottom: 15px; margin-left: -5px; font-family: 'Times New Roman', Times, serif; font-weight: bold">Detail Spesies</h4>
        <div class="row">
            <div class="row mb-3" style="margin-left: -10px; margin-top: 10px">
                <div class="col-sm-5" style="margin-top: 0px">
                    <label class="image-preview" for="image" style="background-image: url('{{ Storage::url($species?->image) }}')">
                        <small>Klik untuk {{ $species ? 'mengganti' : 'mengunggah' }} foto</small>
                        <input type="file" name="image" id="image" class="d-none " accept="image/*">
                    </label>

                    @error('image')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="col-sm-7" style="margin-top: -13px">
                    <div class="mb-3" style="font-size: 14px;">
                        <label for="name" class="form-label">Nama Spesies</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nme" value="{{ old('name', $species?->name) }}" name="name">
                        @error('name')
                        <div class="invaid-feedback">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3" style="font-size: 14px;">
                        <label for="scientific_name" class="form-label">Nama Latin</label>
                        <input type="text" class="form-control @error('scientific_name') is-invalid @enderror" id="scientific_name" value="{{ old('scientific_name', $species?->scientific_name) }}" name="scientific_name">
                        @error('scientific_name')
                        <div class="invaid-feedback">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3" style="font-size: 14px;">
                        <label for="origin" class="form-label">Asal</label>
                        <input type="text" class="form-control @error('origin') is-invalid @enderror" id="origin" value="{{ old('origin', $species?->origin) }}" name="origin">
                        @error('origin')
                        <div class="invaid-feedback">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-3" style="font-size: 14px; display: flex; flex-direction: column;">
                        <label for="category_id" class="form-label" style="margin-bottom: 5px;">Lokasi</label>
                        <div style="display: flex;">
                            <select name="shed_id" class="form-select @error('shed_id') is-invalid @enderror" aria-label="Pilih Lokasi" id="shed_id" style="width: 100%; margin-right: 10px;">
                                <option>-- Pilih --</option>
                                    @foreach($sheds as $shed)
                                        <option value="{{ $shed->id }}" @if($shed->id == $species?->shed->id) selected @endif>{{ $shed->name }}</option>
                                    @endforeach 
                                </select>
                            </div>
    
                            @error('shed_id')
                            <div class="invaid-feedback">
                                <small class="text-danger">{{ $message }}</small>
                            </div>
                            @enderror
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body">
        <h5 style="margin-bottom: 15px; margin-left: -5px; font-family: 'Times New Roman', Times, serif; font-weight: bold">Keterangan Tambahan</h4>
        <div class="row">
            <div class="row mb-2" style="margin-left: -10px; margin-top: 0px">
                    <div class="mb-3">
                        <label for="description" style="margin-left: 2px; margin-bottom: 3px">Deskripsi Singkat</label>
                        <textarea class="form-control  @error('description') is-invalid @enderror"  id="description" name="description" style="height: 120px">{{ $species? $species->description : '' }}</textarea>
                        @error('content')
                        <div class="invaid-feedback">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>
                    <div class="">
                        <label for="article" style="margin-left: 2px; margin-bottom: 3px">Artikel Terkait</label>
                        <textarea class="form-control  @error('article') is-invalid @enderror"  id="article" name="article" style="height: 120px">{{ $species? $species->article : '' }}</textarea>
                        @error('content')
                        <div class="invaid-feedback">
                            <small class="text-danger">{{ $message }}</small>
                        </div>
                        @enderror
                    </div>

                    <div style="text-align: end; margin-top: 15px">
                        <button type="submit" class="btn btn-primary"  style="font-size: 12px;" id="btn-submit" name="btn-submit" >Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>

        $('#image').on('change', function() {
            const preview = $(this).parent();
            const file = this.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.css('background-image', `url('${e.target.result}')`);
            }

            reader.readAsDataURL(file);
        });

    </script>
@endpush
