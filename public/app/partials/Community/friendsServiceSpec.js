/**
 * @module test.evezownapp
 * @name friendsService
 * @description
 * Tests for friendsService under evezownapp
 * _Enter the test description._
 * */


describe('Service: evezownapp.friendsService', function () {

    // load the service's module
    beforeEach(module('evezownapp'));

    // instantiate service
    var service;

    //update the injection
    beforeEach(inject(function (friendsService) {
        service = friendsService;
    }));

    /**
     * @description
     * Sample test case to check if the service is injected properly
     * */
    it('should be injected and defined', function () {
        expect(service).toBeDefined();
    });
});
