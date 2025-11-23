@extends('layouts.app')

@section('title', 'Add Calendar Event')
@section('page-title', 'Add Calendar Event')
@section('content')

<div class="card" style="max-width: 500px; margin: 0 auto; padding: 24px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
<h2 style="margin-bottom: 24px; color: #3d1f2e; text-align: center;">Add New Task</h2>

{{-- Form setup for AJAX submission --}}
<form id="addTaskForm" action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <div style="display: flex; flex-direction: column; gap: 18px;">
        
        {{-- Status/Feedback Message Area --}}
        <div id="statusMessage" style="display:none; padding:10px; border-radius:8px; font-size:14px;"></div>
        
        <input type="hidden" name="course_id" value="1"> 
        
        <div style="display: flex; flex-direction: column; gap: 6px;">
            <label for="event-title" style="font-weight: 600; color: #683844;">Event Title</label>
            <input type="text" id="event-title" name="title" required style="padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
        </div>
        
        <div style="display: flex; flex-direction: column; gap: 6px;">
            <label for="event-date" style="font-weight: 600; color: #683844;">Date</label>
            <input type="date" id="event-date" name="date" required style="padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
        </div>

        <div style="display: flex; flex-direction: column; gap: 6px;">
            <label for="event-time" style="font-weight: 600; color: #683844;">Time (Optional)</label>
            <input type="time" id="event-time" name="time" style="padding: 10px; border-radius: 8px; border: 1px solid #ceb2bd; background: #f9f2e8; color: #3d1f2e; font-size: 15px;">
        </div>
        
        <button type="submit" id="submitButton" style="margin-top: 12px; background: linear-gradient(90deg, #cc4c46ff 0%, #891d1a 100%); color: #fff; border: none; border-radius: 8px; padding: 12px 0; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s;">Add Event</button>
    </div>
</form>


</div>

<script>
document.getElementById('addTaskForm').addEventListener('submit', function(e) {
e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);
    
    // Get elements for feedback
    const statusDiv = document.getElementById(&#39;statusMessage&#39;);
    const submitButton = document.getElementById(&#39;submitButton&#39;);
    
    // Reset feedback display
    statusDiv.style.display = &#39;none&#39;;
    statusDiv.innerHTML = &#39;&#39;;
    submitButton.disabled = true;
    submitButton.textContent = &#39;Saving...&#39;;
    
    const taskDate = formData.get(&#39;date&#39;);
    const taskTime = formData.get(&#39;time&#39;);
    
    // Combine date and time for controller submission
    const combinedDueDate = taskTime ? `${taskDate} ${taskTime}:00` : `${taskDate} 00:00:00`; 

    const data = {
        _token: formData.get(&#39;_token&#39;),
        course_id: formData.get(&#39;course_id&#39;),
        title: formData.get(&#39;title&#39;),
        // Assuming description is not provided in this form, set it to null or remove if not nullable
        description: null, 
        due_date: combinedDueDate, 
    };

    fetch(form.action, {
        method: &#39;POST&#39;,
        headers: {
            &#39;Content-Type&#39;: &#39;application/json&#39;,
            &#39;X-Requested-With&#39;: &#39;XMLHttpRequest&#39;,
        },
        body: JSON.stringify(data)
    })
    .then(response =&gt; {
        if (!response.ok) {
            // Return the error JSON for rejection
            return response.json().then(err =&gt; Promise.reject(err));
        }
        return response.json();
    })
    .then(data =&gt; {
        // Success handling
        statusDiv.style.display = &#39;block&#39;;
        statusDiv.style.backgroundColor = &#39;#e6fff5&#39;;
        statusDiv.style.color = &#39;#00875a&#39;;
        statusDiv.innerHTML = &#39;&lt;strong&gt;Success!&lt;/strong&gt; Task &quot;&#39; + data.task.title + &#39;&quot; saved.&#39;;
        
        // Optionally clear the form or redirect
        form.reset();
    })
    .catch(error =&gt; {
        console.error(&#39;AJAX Error:&#39;, error);
        
        statusDiv.style.display = &#39;block&#39;;
        statusDiv.style.backgroundColor = &#39;#ffeded&#39;;
        statusDiv.style.color = &#39;#891d1a&#39;;

        if (error.errors) {
            // Handle Laravel validation errors (422)
            let errorHtml = &#39;&lt;strong&gt;Please correct the following:&lt;/strong&gt;&lt;ul style=&quot;margin:5px 0 0; padding-left:20px; list-style-type: disc;&quot;&gt;&#39;;
            Object.values(error.errors).flat().forEach(msg =&gt; {
                errorHtml += `&lt;li&gt;${msg}&lt;/li&gt;`;
            });
            errorHtml += &#39;&lt;/ul&gt;&#39;;
            statusDiv.innerHTML = errorHtml;
        } else {
            // Handle general server errors (e.g., 500)
            statusDiv.innerHTML = &#39;An unexpected server error occurred. Check the console for full details.&#39;;
        }
    })
    .finally(() =&gt; {
        submitButton.disabled = false;
        submitButton.textContent = &#39;Add Event&#39;;
    });
});


</script>

@endsection