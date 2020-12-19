@extends('layouts.app_react')
@section('title', 'タスク一覧')

@section('content')

<div class="panel panel-default" style="margin-top: 16px;">
    <div class="panel-heading">
        <div class="row">
            <div class="col-sm-6"><h3>Tasks - index</h3>
            </div>
            <div class="col-sm-6" style="text-align: right;">
                <a href="/tasks/create">[ new ]</a>
            </div>
        </div>
    </div>
    <div id="app"></div>    
</div>
<!-- -->
<!-- -->
<script type="text/babel" src="/js/component/Tasks/IndexRow.js?a1" ></script>

<script type="text/babel">
 var PAGE= {{$page}};

class List extends React.Component {
    constructor(props) {
        super(props);
//        this.state = {data: ''}
        this.state = {data: '', item_count:0, paginate_disp:0 }
    }
    componentDidMount(){
        this.get_items(PAGE);
    }
    get_items(page){
        axios.get("/api/apitasks/get_tasks?page="+ page ).then(res =>  {
//            var items = res.data
            var data = res.data
            var paginate_disp = data.page_item.paginate_disp;
            var arr =[];
console.log(data );
console.log(paginate_disp );
            this.setState({
                data: data.docs, paginate_disp: paginate_disp
            })
        })
    }    
    tabRow(){
        if(this.state.data instanceof Array){
            return this.state.data.map(function(object, index){
                return <IndexRow obj={object} key={index} />
            })
        }
    }
    dispPagenate(){
//console.log(this.state.paginate_disp)
        if(this.state.paginate_disp ===1){
            var url = "/tasks?page="
            return(
            <div className="paginate_wrap">
                <div className="btn-group" role="group" aria-label="Basic example">
                    <a href={url+ 1} className="btn btn-outline-primary"> 1st  </a>
                    <a href={url+ (PAGE+1)} className="btn btn-outline-primary"> > </a>
                </div>
            </div>
            )
        }
    }    
    render(){
        return (
        <div>
            <table className="table table-hover">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                {this.tabRow()}
                </tbody>
            </table> 
            <hr />
            {this.dispPagenate()}
            <br /><br />
        </div>
        )
    }
  
}

ReactDOM.render(<List />, document.getElementById('app'));
</script>
<style>
.p_tbl_task_name{ font-size: 1.2rem; }
.task-table td{ padding : 8px;}
/* .task-table .a_edit_link{ font-size : 1.2rem; } */
.task-table  td i {font-size : 1.2rem; }
</style>

@endsection

