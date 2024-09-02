<x-admin-layout>
    <div class="video-container-admin">
        <form action="/admin/add/video" method="POST" enctype="multipart/form-data">
            @csrf
            @if (session('success'))
            <p style="align-self: center">{{session('success')}}</p>
            @endif
            <label for="video">Upload Advertisment Video:</label>
            <input type="file" name="video" required>
            <input type="submit" name="" id="sumbit-product-form" value="Submit">
            <p><b>Note:</b> If you want to change the video delete the old one and upload a new one.</p>
        </form>
        <div class="cont-video-table">
            @if (session('successs'))
            <p style="align-self: center">{{session('successs')}}</p>
            @endif
            <h2 style="margin:10px">Advertisment Video:</h2>
            <table>
                <thead>
                    <tr>
                        <th>Video</th>
                        <th>Action</th>
                    </tr>    
                </thead>
                <tbody>
                    @foreach($videos as $video)
                    <tr>
                        <td>
                            <video controls>
                                <source src="{{ Storage::url($video->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </td>
                        <td>
                        
                            <a href="/video/delete/{{$video->id}}" style="cursor: pointer"><button type="submit" class="delete" >Delete</button></a>    
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>