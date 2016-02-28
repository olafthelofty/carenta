CLNDR.js - a jquery calendar
============================


Step 1 - Add this to your view file:
---------------------------

.. code-block:: php

    <div class="cal1">
        <script type="text/template" id="template-calendar">
            <?php echo $this->element('Projects/template-calendar'); ?>
        </script>
    </div>

Step 2 - Add this as an element called template-calendar.ctp in Elements/Projects:
----------------------------------------------------------------------------------

.. code-block:: php

    <!--calendar template - see CLNDR.js-->
    <div class="clndr-controls">
                <div class="clndr-control-button"> 
                    <span class="clndr-previous-button btn btn-warning btn-sm"><< previous</span> 
                </div>

                <div class="month btn btn-success btn-sm"><%= month %> <%= year %></div> 
                <div class="clndr-control-button rightalign"> 
                    <span class="clndr-today-button btn btn-success btn-sm">Today</span>
                    <span class="clndr-next-button  btn btn-warning btn-sm">next >></span> 
                </div> 
            </div> 
            <table class="clndr-table" border="0" cellspacing="0" cellpadding="0"> 
                <thead> 
                    <tr class="header-days"> 
                    <% for(var i = 0; i < daysOfTheWeek.length; i++) { %> 
                        <td class="header-day"><%= daysOfTheWeek[i] %></td> 
                    <% } %> 
                    </tr> 
                </thead>

                <tbody> 
                <% for(var i = 0; i < numberOfRows; i++){ %> 
                    <tr> 
                    <% for(var j = 0; j < 7; j++){ %> 
                    <% var d = j + i * 7; %> 
                        <td class="<%= days[d].classes %>"> 
                            <div class="day-contents">
                                <%= days[d].day %>

                  <% _.each(days[d].events, function(event) { %>
                  <p>

                    <button class="btn btn-xs btn-primary" type="button">
                        <%= event.name %>
                    </button>
                </p>
                    <% }); %>
                            </div> 
                        </td> 
                    <% } %> 
                    </tr> 
                <% } %> 
                </tbody> 
            </table>