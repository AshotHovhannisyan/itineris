const { registerBlockType } = wp.blocks;

registerBlockType('itineris/custom-cat', {
    title: 'get terms by post type',
    description: 'Block to generate terms by post type',
    icon: 'format-image',
    category: 'widgets',

    attributes: {},

    edit(){
        return element.createElement(
            'p',
            { style: ''},
            'hello goo'
        );
    },

    save(){}
})