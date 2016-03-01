/**
 * Created by vishu on 20/09/15.
 */
evezownApp.service('classifiedsSharedProperties', function() {
    var stringValue = 'test string value';
    var objectValue = {
        data: 'test object value'
    };

    return {
        getString: function() {
            return stringValue;
        },
        setString: function(value) {
            stringValue = value;
        },
        getObject: function() {
            return objectValue;
        }
    }
});