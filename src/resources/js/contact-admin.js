(function() {
		'use strict';

		function cleanFields(fields) {
			fields.childNodes.forEach(node => {
				//  If we do not have a child return
				if(node.children === undefined)
					return;

				if(node.children[1] !== undefined)
					node.children[1].value = '';

				// clear out any messages that are present
				if(node.classList.contains('alert')) {
					node.remove();
				}
				
			});

			return fields;
		}

		function deleteBtn_Click() {
			let all = document.querySelectorAll('.deleteRow-createFieldsForm ');
			if(all.length <= 1) {
				//  cant be deleted
				let container =  document.querySelector('.contact-container');
 				//  create message
				let message = document.createElement('div');
            		message.className = 'alert alert-danger alert-dismissable';
            		message.innerHTML = 'Can\'t be deleted - Must have one field row';

            	//  add a message to the parents' parent. 
				this.parentNode.parentNode.appendChild(message);
				return false;
			}

			this.parentNode.parentNode.remove();

		}

		const createNewFormRow 	= document.getElementById('createNew-FormRow_Admin');
		const duplicateRow 		= document.getElementById('duplicate-row');
		const deleteBtn 		= document.querySelector('.deleteRow-createFieldsForm ');
		

		deleteBtn.addEventListener('click', deleteBtn_Click);


		createNewFormRow.addEventListener('click', function() {

			let clone 	= duplicateRow.cloneNode(true);
			let form 	= document.getElementById('createFieldsFormRow');
			let cleaned = cleanFields(clone);

			cleaned.querySelector('.deleteRow-createFieldsForm').addEventListener('click', deleteBtn_Click);
			form.appendChild(cleaned);

		});

	})();