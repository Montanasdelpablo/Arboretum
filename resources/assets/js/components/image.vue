<template>
    <progressive-img
        :src="require(`@/images${src}`).src"
        :placeholder="require(`@/images${src}`).placeholder"
        :alt="alt"
    />
</template>

<script>
	export default
	{
		props: {
			src: {
				type: String,
				required: true,
				default: ''
			},
			alt: {
				type: String,
				required: false,
				default: '',
			}
		},
	}
</script>