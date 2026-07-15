 <table class="table table-bordered table-hover align-middle" id="referenceTable">
     <thead class="table-dark text-center">
         <tr>
             <th>Date</th>
             <th>Source</th>
             <th>Name</th>
             <th>Mobile</th>
             <th>Product</th>
             <th>Area</th>
             <th>Location</th>
             <th>Status</th>
             <th>Action</th>
         </tr>
     </thead>
     <tbody>
         @foreach ($referenceLeads as $reflead)
         <tr>
             <td>{{ $reflead->created_at->format('d M Y') }}</td>
             <td>{{ $reflead->source }}</td>
             <td>{{ $reflead->Name }}</td>
             <td>{{ $reflead->Mobile }}</td>
             <td>{{ $reflead->Product }}</td>
             <td>{{ $reflead->Total_Area }}Sq.ft</td>
             <td>{{ $reflead->Site_location }}</td>
             <td>{{ $reflead->Status }}</td>
             <td>
                 <div class="d-flex justify-content-center gap-1">
                     <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#feedbackModal1{{ $reflead->id }}" data-lead-id="{{ $reflead->id }}">
                         Feedback
                     </button>
                     &nbsp;
                     <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#timelineModal1{{ $reflead->id }}" data-lead-id="{{ $reflead->id }}">
                         Timeline
                     </button>
                 </div>
                 <div class="modal fade" id="feedbackModal1{{ $reflead->id }}" tabindex="-1">
                     <div class="modal-dialog">
                         <div class="modal-content">

                             <form method="POST" action="{{ route('addfeedback') }}">
                                 @csrf

                                 <div class="modal-header">
                                     <h5 class="modal-title">Add Feedback</h5>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                 </div>

                                 <div class="modal-body">
                                     <input type="hidden" name="lead_id" value="{{ $reflead->id }}">

                                     <div class="mb-3">
                                         <label>Feedback</label>
                                         <textarea name="feedback" class="form-control" required></textarea>
                                     </div>
                                     <div class="mb-3">
                                         <label>Status</label>
                                         <select class="form-select" aria-label="Default select example" name="status">
                                             <option value="Details shared">Details
                                                 shared</option>
                                             <option value="Follow up">Follow up</option>
                                             <option value="Confirmed">Confirmed</option>
                                             <option value="Quote Shared">Quote Shared</option>
                                             <option value="RNR">RNR</option>
                                             <option value="Cancelled">Cancelled</option>
                                         </select>
                                     </div>
                                 </div>

                                 <div class="modal-footer">
                                     <button type="submit" class="btn btn-success">
                                         Save Feedback
                                     </button>
                                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                         Cancel
                                     </button>
                                 </div>

                             </form>

                         </div>
                     </div>
                 </div>

             </td>
         </tr>

         <!--Feedback Timeline model-->
         <div class="modal fade" id="timelineModal1{{ $reflead->id }}" tabindex="-1">
             <div class="modal-dialog">
                 <div class="modal-content">

                     <div class="modal-header">
                         <h5 class="modal-title">Timeline</h5>
                         <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                     </div>

                     <div class="modal-body">
                         <input type="hidden" name="lead_id" value="{{ $reflead->id }}">

                         <div class="card mb-4">
                             <div class="card-header bg-primary text-white">
                                 Name: {{ $reflead->id }} : {{ $reflead->Name }} ------ Source:
                                 {{ $reflead->source }}
                             </div>

                             <div class="card-body">
                                 <div class="timeline">

                                     <!-- Lead Created -->
                                     <div class="timeline-item">
                                         <span class="timeline-dot"></span>
                                         <div class="timeline-card">
                                             <strong>Lead Created</strong><br>
                                             <span class="timeline-date">
                                                 {{ $reflead->created_at->format('d M Y h:i A') }}
                                             </span>
                                         </div>
                                     </div>

                                     <!-- Initial Enquiry -->
                                     @if (!empty($reflead->Description))
                                     <div class="timeline-item">
                                         <span class="timeline-dot bg-info"></span>
                                         <div class="timeline-card">
                                             <strong>Initial Enquiry</strong><br>
                                             <span class="timeline-date">
                                                 {{ $reflead->created_at->format('d M Y h:i A') }}
                                             </span>

                                             <p class="mb-0 mt-1">
                                                 {{ $reflead->Description }}
                                             </p>
                                         </div>
                                     </div>
                                     @endif

                                     <!-- Feedback History -->
                                     @forelse($reflead->feedbacks as $fb)
                                     <div class="timeline-item">
                                         <span class="timeline-dot bg-success"></span>
                                         <div class="timeline-card">
                                             <strong>Feedback</strong><br>
                                             <span class="timeline-date">
                                                 {{ $fb->created_at->format('d M Y h:i A') }}
                                             </span>

                                             <p class="mb-0 mt-1">
                                                 {{ $fb->feedback }}
                                             </p>
                                         </div>
                                     </div>
                                     @empty
                                     <div class="timeline-item">
                                         <div class="timeline-card">
                                             <p class="text-muted mb-0">
                                                 No feedback available yet.
                                             </p>
                                         </div>
                                     </div>
                                     @endforelse

                                 </div>
                             </div>
                         </div>
                     </div>

                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                             Cancel
                         </button>
                     </div>
                 </div>
             </div>
         </div>
         @endforeach
         <!--end Timeline model-->

     </tbody>
 </table>
