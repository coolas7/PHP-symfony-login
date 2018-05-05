const users = document.getElementById('deleteUser');

if(users) {
	users.addEventListener('click', e => {
		if (e.target.className === 'del-btn') {

			if (confirm('Ar tikrai ištrinti?')) {
				const id = e.target.getAttribute('data-id');

				fetch(`/deleteuser/${id}`, {
					method: 'DELETE'
				}).then(res => window.location.reload());
			}
		}
	}); 
}

const tasks = document.getElementById('deleteTask');

if(tasks) {
	tasks.addEventListener('click', e => {
		if (e.target.className === 'del-btn') {

			if (confirm('Ar tikrai ištrinti?')) {
				const id = e.target.getAttribute('data-id');
				
				fetch(`/deletetask/${id}`, {
					method: 'DELETE'
				}).then(res => window.location.reload());
			}
		}
	}); 
}