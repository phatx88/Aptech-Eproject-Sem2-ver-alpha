<script>
    // Toast Nofication 
    const notyf = new Notyf({
        duration: 3000,
        position: {
            x: 'right',
            y: 'top',
        },
        types: [{
                type: 'warning',
                background: 'orange',
                duration: 2000,
                icon: {
                    className: 'material-icons',
                    tagName: 'i',
                    text: 'warning'
                }
            },
            {
                type: 'error',
                background: 'indianred',
                duration: 2000,
                dismissible: true
            }
        ]
    });

</script>