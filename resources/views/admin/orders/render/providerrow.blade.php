<div class="col-md-12">
    <div class="row">
        <div class="col-md-11">
            <div class="form-group">
                <div class="row mb-3">
                    <div class="col-md-12" id="getprovider">
                        
                    </div>
                    
                </div>
            </div>
        </div>
        <div style="padding:0px;" class="col-md-1">
            <div class="dropdown dropdown-inline">
                <a href="#" class="btn btn-icon btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <span class="material-symbols-outlined">more_vert</span>
                </a>
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <ul class="navi navi-hover" id="providerlinks">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label>Provider Services Offerd </label>
        <select multiple class="form-control"  name="providerservice" id="showchildservices" onchange="selectplan(this.value)">
            
        </select>
    </div>
</div>
<style type="text/css">
     #getprovider {
        display: flex;
        flex-wrap: wrap;
        gap: 10px; /* Adds space between buttons */
    }

    #getprovider .button {
        flex: 0 1 auto; /* Allows buttons to shrink/grow naturally based on content */
        margin: 5px; /* Adds space around each button */
    }

    #getprovider .btn {
        display: inline-block;
        padding: 5px 5px;
        font-size: 12px;
        font-weight: 500;
        color: black;
        background-color: #ddd;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    #getprovider .btn:hover {
        background-color: #1370f2;
        color: white;
    }

    #getprovider input[type="radio"] {
        display: none; /* Hides the radio button */
    }

    #getprovider input[type="radio"]:checked + label {
        background-color: #1370f2;
        color: white;
    }


</style>