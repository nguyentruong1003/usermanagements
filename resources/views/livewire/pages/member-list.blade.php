
<div class="card">
    <div class="row">
        <h5 class="card-header">DANH SÁCH THÀNH VIÊN</h5>
    </div>
    <div class="col-md-12 px-2">
        <div class="row">
            <div class="col-md-9">
                <div class="form-group search-expertise">
                    <div class="search-expertise inline-block">
                        <input type="text" placeholder="{{__('common.button.search')}}" name="searchTerm" class="form-control" wire:model.live.debounce.500ms="searchTerm" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="col-md-3">
              @include('livewire.common.buttons._create')
            </div>
        </div>
    </div>
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Họ và Tên</th>
            <th>Email</th>
            <th>SĐT</th>
            <th>Giới Tính</th>
            {{-- <th>Địa Chỉ</th> --}}
            {{-- <th>Sở Thích</th> --}}
            <th>Trình độ</th>
            {{-- <th>Ghi chú</th> --}}
            <th>Actions</th>
          </tr>
        </thead>
        <tbody class="table-border-bottom-0">
          @forelse($data as $key => $row)
          <tr>
            <td>{{ ($data->currentPage() - 1) * $data->perPage() + $loop->iteration }}</td>
            <td>{{ $row->name }}</td>
            <td>{{ $row->email }}</td>
            <td>{{ $row->phone }}</td>
            <td>{{ \App\Enums\ECommon::codeToValue(1, $row->sex) }}</td>
            {{-- <td>{{ $row->address }}</td> --}}
            {{-- <td>{{ $row->hobby }}</td> --}}
            <td>{{ $row->level }}</td>
            {{-- <td>{{ $row->note }}</td> --}}
            <td>
              <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  @include('livewire.common.buttons._edit')
                  @include('livewire.common.buttons._delete')
                  <button class="dropdown-item" wire:click="exportImage({{$row->id}})" data-bs-toggle="modal" data-bs-target="#infoImgModal"><i class="bx bx-edit-alt me-1"></i> Export</button>
                </div>
              </div>
            </td>
          </tr>
          @empty
              <td colspan='12' class='text-center'>{{__('common.message.no_record')}}</td>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="p-5">
    @if(count($data))
      {{ $data->links() }}
    @endif
  </div>
  @include('livewire.common.modal._modalDelete')

  <div wire:ignore.self class="modal fade" id="createEditModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCenterTitle">{{ $mode == 'create' ? "Thêm mới" : "Chỉnh sửa"}}</h5>
          <button type="button" class="btn-close" id="close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form>
            <div class="row">
              <div class="col mb-3">
                <label for="nameWithTitle" class="form-label">Họ Tên</label><span class="text-danger"> (*)</span>
                <input name="name" wire:ignore wire:model.lazy="name" type="text" id="nameWithTitle" class="form-control" placeholder="Enter Name">
              </div>
            </div>
            <div class="row g-2">
              <div class="col mb-0">
                <label for="birthdayWithTitle" class="form-label">Ngày Sinh</label>
                <input name="birthday" wire:ignore wire:model.lazy="birthday" type="date" id="birthdayWithTitle" class="form-control">
              </div>
              <div class="col mb-0">
                <label for="sexWithTitle" class="form-label">Giới Tính</label>
                <select name="sex" id="" wire:model.lazy="sex" class="form-control">
                  <option value="">-- Chọn --</option>
                  @foreach (\App\Enums\ECommon::getListData()[1] as $key =>$item)
                  <option value="{{$key}}">{{$item}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="row g-2">
              <div class="col mb-0">
                <label for="emailWithTitle" class="form-label">Email</label>
                <input name="email" wire:ignore wire:model.lazy="email" type="email" id="emailWithTitle" class="form-control" placeholder="xxxx@xxx.xx">
              </div>
              <div class="col mb-0">
                <label for="phoneWithTitle" class="form-label">SĐT</label>
                <input name="phone" wire:ignore wire:model.lazy="phone" type="number" id="phoneWithTitle" class="form-control" placeholder="Enter phone">
              </div>
            </div>
            <div class="row g-2">
              <div class="col mb-0">
                <label for="levelWithTitle" class="form-label">Trình độ</label>
                <input name="level" wire:ignore wire:model.lazy="level" type="text" id="levelWithTitle" class="form-control" placeholder="Enter Level">
              </div>
              <div class="col mb-0">
                <label for="hobbyWithTitle" class="form-label">Sở thích</label>
                <input name="hobby" wire:ignore wire:model.lazy="hobby" type="text" id="hobbyWithTitle" class="form-control" placeholder="Enter Hobby">
              </div>
            </div>
            <div class="row g-2">
              <div class="col mb-0">
                <label for="addressWithTitle" class="form-label">Địa chỉ</label>
                <input name="address" wire:ignore wire:model.lazy="address" type="text" id="addressWithTitle" class="form-control" placeholder="Enter Address">
              </div>
            </div>
            <div class="row g-2">
              <div class="col mb-0">
                <label for="noteWithTitle" class="form-label">Ghi chú</label>
                <input name="note" wire:ignore wire:model.lazy="note" type="text" id="noteWithTitle" class="form-control" placeholder="Enter Note">
              </div>
            </div>
            <div class="row g-2 mt-1">
                <label for="formFile" class="form-label">Ảnh 3x4</label>
                <input name="image" wire:ignore wire:model.lazy="image" class="form-control" type="file" id="formFile" accept="image/*">
                <div class="preview-file">
                  @if($image)
                      <div class="form_content ml-2 form-group preview-data" data="{{ './storage/'. $image }}">
                          <div class="py-2 px-3 bg-light d-flex align-items-center" id="preview-item">
                              @if($tmpUrl)
                              <a href="{{ asset($tmpUrl) }}" target="_blank">
                                  <i class="fas fa-file mr-2"></i> {{$image}}
                              </a>
                              @else
                              <a href="{{ asset($tmpUrl) }}" target="_blank" onclick="return false;" style="cursor: default;">
                                <i class="fas fa-file mr-2"></i> {{$image}}
                            </a>
                              @endif
                              <div class="border-left ml-2 px-2 btn btn-md" id="removeFile" wire:click="$dispatch('remove_path')">
                                  <i class="fa fa-times mr-1"></i> Xóa
                              </div>
                          </div>
                          @if($tmpUrl)
                          <div>
                            <img src="{{ asset($tmpUrl) }}" style="max-width:600px;width:100%" alt="Avatar">
                          </div>
                          @endif
                      </div>
                  @endif
              </div>
              <input class="form-control" type="hidden" name="remove_path" id="remove_path"/>
            </div>    
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" wire:click="saveData">{{ $mode == 'create' ? "Tạo" : "Lưu thay đổi"}}</button>
        </div>
      </div>
    </div>
  </div>

  <div wire:ignore.self class="modal fade" id="infoImgModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-uppercase" id="modalCenterTitle">{{ $name }}</h5>
          <button type="button" class="btn-close" id="close-modal" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <canvas id="member-info-img" width="750" height="800"></canvas>
          <div id="member-info-data" style="display: none;">
            <img id="source" src="{{ asset($tmpUrl) }}" style="max-width:600px;width:80%" alt="Avatar">
          </div>
        </div>
      </div>
    </div>
  </div>

</div>

<script>
  window.addEventListener('show-member-info-img', event => {
      data = event.detail[0];
      console.log(data);
      
      const canvas = document.getElementById('member-info-img');
      const ctx = canvas.getContext('2d');
      const img = document.getElementById('source');
      ctx.fillStyle = 'white';
      ctx.fillRect(0, 0, canvas.width, canvas.height);

      function wrapText(ctx, text, x, y, maxWidth, lineHeight) {
          const words = text.split(' ');
          let line = '';

          for (let i = 0; i < words.length; i++) {
              const testLine = line + words[i] + ' ';
              const metrics = ctx.measureText(testLine);
              const testWidth = metrics.width;

              if (testWidth > maxWidth && i > 0) {
                  ctx.fillText(line, x, y);
                  line = words[i] + ' ';
                  y += lineHeight;
              } else {
                  line = testLine;
              }
          }
          ctx.fillText(line, x, y);
          return y + lineHeight;
      }
      function drawData() {
        ctx.font = '20px Arial';
        ctx.fillStyle = 'black';

        const texts = [
            'Họ Tên     :  ' + data.name,
            'Giới tính   :  ' + (data.sex == 1 ? 'Nam' : 'Nữ'),
            'Sinh nhật :  ' + data.birthday,
            'Email       :  ' + data.email,
            'SĐT         :  ' + data.phone,
            'Địa chỉ     :  '
        ];

        let startX = 220;
        let startY = 30;
        let maxWidth = 750
        let lineHeight = 24

        texts.forEach((text, index) => {
          if (index == 5) {
            ctx.fillText(text, startX, startY + (index * 30));
            wrapText(ctx, data.address, startX + 110, startY + (index * 30), maxWidth - startX - 110, lineHeight);
          } else 
            ctx.fillText(text, startX, startY + (index * 30));
        }); 

        nextY = startY+270
        if (data.hobby && data.note) {
          const nextY = wrapText(ctx, 'Sở thích: '+data.hobby, 10, startY+270, maxWidth, lineHeight);  
          wrapText(ctx, 'Ghi chú: '+data.note, 10, nextY + 20, maxWidth, lineHeight);
        }
        else if (data.hobby) {
          wrapText(ctx, 'Sở thích: '+data.hobby, 10, startY+270, maxWidth, lineHeight);  
        }
        else if (data.note) {
          wrapText(ctx, 'Ghi chú: '+data.note, 10, startY+270, maxWidth, lineHeight);  
        }
      }
      if (data.image) {
        img.onload = function () {
          ctx.drawImage(img, 10, 10, 180, 240);
          drawData();
        };
        try {
          ctx.drawImage(img, 10, 10, 180, 240);
          drawData();
        } catch (error) {
          console.log('img already exist');
        }
      } else {
        ctx.font = '20px Arial';
        ctx.fillStyle = 'black';
        ctx.fillText('No image', 10, 50);
        drawData();
      }
  });
</script>