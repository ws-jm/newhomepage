$(function() {
    $('.adv-table').footable({
      filtering: {
        enabled: true
      },
      "paging": {
              "enabled": true,
			  "current": 1
	  },
      strings: {
        enabled: false
      },
      "filtering": {
              "enabled": true
          },
      components: {
          filtering: FooTable.MyFiltering
      },
    }); 
  });
  
FooTable.MyFiltering = FooTable.Filtering.extend({
	construct: function(instance){
		this._super(instance);
		// props for the first dropdown
		this.statuses = ['Web Developer','Senior Manager','UX/UI Desogner','Content Writer','Graphic Designer','Marketer','Project Manager','UI Designer','Business Development'];
		this.statusDefault = 'All';
		this.$status = null;
		// props for the second dropdown
		this.jobTitles = ['Active','deactivate','Blocked'];
		this.jobTitleDefault = 'All';
		this.$jobTitle = null;
	},
	$create: function(){
		this._super();
		var self = this;
		// create the status form group and dropdown
		var $status_form_grp = $('<div/>', {'class': 'form-group atbd-select d-flex align-items-center adv-table-searchs__position my-md-25 my-15 mr-sm-20 mr-0 '})
			.append($('<label/>', {'class': 'd-flex align-items-center mb-sm-0 mb-2', text: 'position'}))
			.prependTo(self.$form);

		self.$status = $('<select/>', { 'class': 'form-control ml-sm-10 ml-0' })
			.on('change', {self: self}, self._onStatusDropdownChanged)
			.append($('<option/>', {text: self.statusDefault}))
			.appendTo($status_form_grp);

		$.each(self.statuses, function(i, status){
			self.$status.append($('<option/>').text(status));
		});



		// create the job title form group and dropdown
		var $job_title_form_grp = $('<div/>', {'class': 'form-group atbd-select d-flex align-items-center adv-table-searchs__status my-md-25 mt-15 mb-0 mr-sm-30 mr-0'})
			.append($('<label/>', {'class': 'd-flex align-items-center mb-sm-0 mb-2', text: 'Status'}))
			.prependTo(self.$form);

		self.$jobTitle = $('<select/>', { 'class': 'form-control ml-sm-10 ml-0' })
			.on('change', {self: self}, self._onJobTitleDropdownChanged)
			.append($('<option/>', {text: self.jobTitleDefault}))
			.appendTo($job_title_form_grp);

		$.each(self.jobTitles, function(i, jobTitle){
			self.$jobTitle.append($('<option/>').text(jobTitle));
		});
	},
	_onStatusDropdownChanged: function(e){
		var self = e.data.self,
			selected = $(this).val();
		if (selected !== self.statusDefault){
			self.addFilter('position', selected, ['position']);
		} else {
			self.removeFilter('position');
		}
		self.filter();
	},
	_onJobTitleDropdownChanged: function(e){
		var self = e.data.self,
			selected = $(this).val();
		if (selected !== self.jobTitleDefault){
			self.addFilter('status', selected, ['status']);
		} else {
			self.removeFilter('status');
		}
		self.filter();
	},
	draw: function(){
		this._super();
		// handle the status filter if one is supplied
		var status = this.find('position');
		if (status instanceof FooTable.Filter){
			this.$status.val(status.query.val());
		} else {
			this.$status.val(this.statusDefault);
		}

		// handle the jobTitle filter if one is supplied
		var jobTitle = this.find('status');
		if (jobTitle instanceof FooTable.Filter){
			this.$jobTitle.val(jobTitle.query.val());
		} else {
			this.$jobTitle.val(this.jobTitleDefault);
		}
	}
});