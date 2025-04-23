<link href="bootstrap.min.css" rel="stylesheet">
<link href="custom.css" rel="stylesheet">

<style>
   #job-list .transition{
        border-radius: 12px;
        border: 1px solid #fff ;
    }
    #job-list .transition:hover{
        border: 1px solid #001aab !important;
    }
    .text-xl{
        font-size: 24px;
    }
    #job-list .transition:hover .text-xl{
        text-decoration: underline;
    }
    .fa-pencil{
        transform: rotate(276deg); 
    }
</style>
<div id="job-list" class="space-y-4 p-4">
    <!-- One Job Card -->
    <div class="border rounded-lg p-4 shadow hover:shadow-md transition">
        <h2 class="text-xl font-bold text-gray-800">{{$job->title}}</h2>
        <p class="text-gray-600">{{$job->location}}</p>
        <div class="flex flex-wrap gap-2 mt-2">
            <span class="bg-green-100 text-green-800 text-sm font-semibold px-3 py-1 rounded-full">{{$job->salary}} a month <i class="fa-solid fa-check"></i></span>
            <span class="bs-teal text-green-800 text-sm font-semibold px-3 py-1 rounded-full">{{$job->type}}<i class="fa-solid fa-check"></i></span>
            <span class="bg-gray-200 text-gray-800 text-sm font-semibold px-3 py-1 rounded-full">Day shift</span>
        </div>
        <h6><a href=""><i class="fa-solid fa-pencil"></i> Easy Apply</a></h6>
        <ul class="mt-2 list-disc list-inside text-gray-700 text-sm">
            @php
              $desArray = explode('.',$job->description);
              
            @endphp
            @for($i = 0; $i <= count($desArray) - 2;$i++)
                <li>{{$desArray[$i]}}</li>
            @endfor
        </ul>
        <p class="text-xs text-gray-500 mt-2">{{$job->create_at}}</p>
    </div>
</div>