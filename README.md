验证器
1. 高级写法
protected $rule = [
    ['name','require|max:10', '名称不能为空|名称的最大长度不能超过10位'],
];
2. 场景使用
protected $scene = [
        'edit'  =>  ['nwame','age'],
];
 
3. 接口新增(getMenuDetail)


eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczpcL1wvd3d3LnFpaHVpc2hvdS5jb20iLCJhdWQiOiJodHRwczpcL1wvd3d3LnFpaHVpc2hvdS5jb20iLCJpYXQiOjE1OTgyNDkyNzUsIm5iZiI6MTU5ODI0OTI3NSwiZGF0YSI6eyJ1c2VySWQiOiI5ODc2NTQzMjEiLCJ1c2VybmFtZSI6ImZ0bCJ9fQ.mnf2z1BNFOoea2ntXRUDZTOkKYtiUAIlqfZNFIo0kwU



